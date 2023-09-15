<?php

namespace App\Models\Fortnox;

use App\Settings;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Fortnox
{
    public $url;
    protected $response;
    protected $error;
    protected $metadata;
    protected $entities = [
        'AbsenceTransaction',
        'Account',
        'Article',
        'ArticleFileConnection',
        'Assets',
        'AssetFileConnection',
        'AttendanceTransaction',
        'ContractAccrual',
        'ContractTemplate',
        'Contract',
        'CostCenter',
        'Currency',
        'Customer',
        'Employee',
        'Expense',
        'FinancialYear',
        'InvoiceAccrual',
        'InvoicePayment',
        'Invoice',
        'Label',
        'Offer',
        'Order',
        'PriceList',
        'Project',
        'SalaryTransaction',
        'SupplierInvoiceAccrual',
        'SupplierInvoicePayment',
        'SupplierInvoiceFileConnection',
        'SupplierInvoice',
        'Supplier',
        'TaxReduction',
        'TermsOfDelivery',
        'TermsOfPayment',
        'Unit',
        'VoucherFileConnection',
        'WayOfDelivery',
    ];

    protected $special_entities = [
        'AccountCharts' => ['plural' => 'AccountCharts', 'url' => 'accountcharts'], // no singular
        'Archive' => ['plural' => '', 'url' => 'archive'],   // lots of things
        'AssetType' => ['plural' => 'Types', 'url' => 'assets/types'], // Asset types is bugged, have to send an AssetType, but is getting Type/Types
        'CompanyInformation' => ['plural' => 'CompanyInformation', 'url' => 'companyinformation'],  // No plural
        'CompanySettings' => ['plural' => '', 'url' => 'settings/company'], // No singular
        'Inbox' => ['plural' => '', 'url' => 'inbox'],   // one entity for the entities Folders and Files
        'FileAttachment' => ['plural' => '', 'url' => ''],
        'LockedPeriod' => ['plural' => '', 'url' => 'lockedperiod'],  // no plural
        'ModeOfPayment' => ['plural' => 'ModesOfPayments', 'url' => 'modesofpayments'],  // wrong pluralization
        'NoxFinansInvoice' => ['plural' => '', 'url' => 'noxfinansinvoices'],  // no plural
        'PreDefinedAccounts' => ['plural' => 'PreDefinedAccounts', 'url' => 'predefinedaccounts'],  // no singular
        'PreDefinedVoucherSeries' => ['plural' => 'PreDefinedVoucherSeries', 'url' => 'predefinedvoucherseries'],  // no singular
        'Price' => ['plural' => 'Prices', 'url' => 'prices'],  // requires pricelist/article{/quantity} in url, no plural?
        'PrintTemplates' => ['plural' => 'PrintTemplates', 'url' => 'printtemplates'],  // no singular
        'ScheduleTime' => ['plural' => '', 'url' => 'scheduletimes'], // no plural, need employeeId/date in url
        //'SIE' => ['plural' => 'SIE', 'url' => 'sie'],           // no plural, type 1-4 in url, streamed content
        'SupplierInvoiceExternalURLConnection' => ['plural' => '', 'url' => ''],  // no plural
        'TrustedDomain' => ['plural' => 'TrustedDomains', 'url' => 'emailtrusteddomains'],  // special url
        'EmailSender',  // use of /trusted in url on create, no singular on get, but on create
        'VoucherSeries' => ['plural' => 'VoucherSeriesCollection', 'url' => 'voucherseries'],  // special plural
        'Voucher' => ['plural' => 'Vouchers', 'url' => 'vouchers', 'parameter' => 'financialyear'],  // on get, need parameter financialyear=? and need voucherSeries in url
    ];

    protected $scopes = [
    //    "settings",
        "bookkeeping",
    //    "connectfile",
        "invoice",
    //    "supplier",
    //    "supplierinvoice",
    //    "payment",
        "profile",
    //    "project",
    //    "print",
        "price",
    //    "order",
    //    "offer",
        "inbox",
        "customer",
    //    "currency",
        "costcenter",
        "companyinformation",
        "article",
    //    "archive",
    ];

    protected static $last_call = null;
    protected static $last_call_cache_key = 'fortnox_last_call';

    public function __construct()
    {
        $this->url = config('services.fortnox.url', 'https://api.fortnox.se/3/');
        $this->metadata = [];
        $settings = settings();
        if (!isset($settings[self::$last_call_cache_key])) {
            settings()->put(self::$last_call_cache_key, now());
        }
        if (null === self::$last_call) {
            self::$last_call = Carbon::make(settings(self::$last_call_cache_key, now()));
        }
    }

    public function __destruct()
    {
        if (self::$last_call !== null && self::$last_call->greaterThan(Carbon::make(settings(self::$last_call_cache_key, now())))) {
            settings()->put(self::$last_call_cache_key, self::$last_call);
        }
    }

    public function generateAuthURL(string $state): string
    {
        $vars = [
                'client_id' => config("services.fortnox.oauth_client_id"),
                'scope' => implode(" ", $this->scopes),
                'state' => $state,
                'access_type' => 'offline',
                'response_type' => 'code',
            ];
        settings()->put('fortnox_state', $state);
        return config('services.fortnox.oauth_url')."auth?".http_build_query($vars, "", "&", PHP_QUERY_RFC3986);
    }

    public function exchangeAccessToken(string $authCode, string $state): void
    {
        $settings = settings();
        if (settings('fortnox_state') == $state) {
            $body =[
                'grant_type'=>'authorization_code',
                'code' => $authCode,
                'redirect_uri' => config('services.fortnox.client_redirect_uri'),
            ];

            $response = Http::withBasicAuth(config('services.fortnox.oauth_client_id'), config('services.fortnox.oauth_client_secret'))
                ->asForm()
                ->post(config('services.fortnox.oauth_url')."token", $body);

            $result = json_decode($response->getBody()->getContents(), true);
            if (!isset($result['error'])) {
                $settings->forget('fortnox_error');
                $settings->forget('fortnox_error_description');
            }
            foreach ($result as $key => $value) {
                $settings->put('fortnox_'.$key, $value);
            }
        }
    }

    public function refreshAccessToken()
    {
        $settings = settings();

        $body =[
            'grant_type' => 'refresh_token',
            'refresh_token' => settings('fortnox_refresh_token'),
        ];

        $response = Http::withBasicAuth(config('services.fortnox.oauth_client_id'), config('services.fortnox.oauth_client_secret'))
            ->asForm()
            ->post(config('services.fortnox.oauth_url')."token", $body);


        $result = json_decode($response->getBody()->getContents(), true);
        if (!isset($result['error'])) {
            $settings->forget('fortnox_error');
            $settings->forget('fortnox_error_description');
        }
        foreach ($result as $key => $value) {
            $settings->put('fortnox_'.$key, $value);
        }
        $settings->put('fortnox_token_expire', now()->addSeconds($result['expires_in']));
    }

    public function hasExpiredToken(): bool
    {
        $expire_time = Carbon::make(settings('fortnox_token_expire'));
        return now()->greaterThan($expire_time);
    }

    public function getPluralEntity($entity)
    {
        if (in_array($entity, $this->entities)) {
            return Str::plural($entity);
        } elseif (isset($this->special_entities[$entity])) {
            $plural = $this->special_entities[$entity]['plural'];
            if (!empty($plural)) {
                return $plural;
            }
        }
        return false;
    }

    public function getEntityURL($entity)
    {
        if (in_array($entity, $this->entities)) {
            return strtolower(Str::plural($entity));
        } elseif (isset($this->special_entities[$entity])) {
            $url = $this->special_entities[$entity]['url'];
            if (!empty($url)) {
                return $url;
            }
        }
        return false;
    }

    protected function wait($wait = 1)
    {
        $cache_call = Carbon::make(settings(self::$last_call_cache_key, now()));
        if ($cache_call->greaterThan(self::$last_call)) {
            self::$last_call = $cache_call;
        }
        $wait = 250000 * $wait;
        $diff = self::$last_call->diffInMicroseconds();
        if ($diff < $wait) {
            usleep($wait - $diff);
        }
        self::$last_call = now();
        settings()->put(self::$last_call_cache_key, now());
    }

    public function makeCall($method, $entityPath, $body = null)
    {
        // if ($this->hasExpiredToken()) {
        $this->refreshAccessToken();
        // }
        $response = null;
        switch ($method) {
            case 'get':
                $response = Http::withToken(settings('fortnox_access_token'))->get($this->url.$entityPath, $body);
                break;

            case 'post':
                $response = Http::withToken(settings('fortnox_access_token'))->post($this->url.$entityPath, $body);
                break;

            case 'put':
                $response = Http::withToken(settings('fortnox_access_token'))->put($this->url.$entityPath, $body);
                break;

            case 'delete':
                $response = Http::withToken(settings('fortnox_access_token'))->delete($this->url.$entityPath, $body);
                break;

        }
        return $response;
    }

    public function call($method, $entity, $body = null)
    {
        $method = strtolower($method);
        $wait = 1;
        do {
            $this->wait($wait++);
            $response = $this->makeCall($method, $entity, $body);
        } while ($response->getStatusCode() == 429 || $wait > 10);

        $this->response = $response;
        if ($response->successful()) {
            return $response->getBody()->getContents();
        } else {
            $this->error = $response->getBody()->getContents();
            Log::info($this->error);
            $this->metadata = [];
            return json_encode([]);
        }
    }

    public function parse(string $json, $entity)
    {
        $array = json_decode($json, true);
        if (isset($array[$entity])) {
            return $array[$entity];
        }
        return [];
    }

    public function getLastResponse()
    {
        return $this->response;
    }

    public function getLastError()
    {
        $error = json_decode($this->error, true);
        if (null === $error) {
            return $this->error;
        } else {
            return $this->parse($this->error, 'ErrorInformation');
        }
    }

    public function getOne($id, $parameters = '', $entity = null)
    {
        if ($entity === null) {
            $entity = $this->getCallerClass();
        }
        $entity_url = $this->getEntityURL($entity);
        $url = $entity_url.'/'.$id.$parameters;
        $json = $this->call('get', $url);
        $this->metadata = [];
        return $this->parse($json, $entity);
    }

    public function put($array, $id, $entity = null)
    {
        if ($entity === null) {
            $entity = $this->getCallerClass();
        }
        $entity_url = $this->getEntityURL($entity);

        $response = $this->call('put', $entity_url.'/'.$id, [$entity => $array]);
        return $this->parse($response, $entity);
    }

    public function post($array, $entity = null)
    {
        if ($entity === null) {
            $entity = $this->getCallerClass();
        }
        $entity_url = $this->getEntityURL($entity);

        $response = $this->call('post', $entity_url, [$entity => $array]);
        return $this->parse($response, $entity);
    }

    public function getList($parameters = '', $page = 1, $limit = 100, $entity = null)
    {
        if ($entity === null) {
            $entity = $this->getCallerClass();
        }
        $entity_plural = $this->getPluralEntity($entity);
        if ($entity_plural === false) {
            return [];
        }
        $entity_url = $this->getEntityURL($entity);
        $limit = ($limit = 100) ? '' : '&limit='.$limit;
        $url = $entity_url.'?page='.$page.$limit;
        $json = $this->call('get', $url);
        $this->metadata = $this->parse($json, 'MetaInformation');
        return $this->parse($json, $entity_plural);
    }

    public function getLastMetadata()
    {
        return $this->metadata;
    }

    public function hasMorePages()
    {
        if (empty($this->metadata)) {
            return false;
        }
        return ($this->metadata['@CurrentPage'] < $this->metadata['@TotalPages']);
    }

    protected function getCallerClass()
    {
        $class = Str::after(class_basename(debug_backtrace(0, 3)[2]['class']), 'Fortnox');
        return $class;
    }
}
