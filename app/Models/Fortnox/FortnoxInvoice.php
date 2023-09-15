<?php

namespace App\Models\Fortnox;

use Illuminate\Support\Facades\App;
use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fortnox\FortnoxInvoiceRow;

class FortnoxInvoice extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='document_number';
    protected $fortnox_relations= [
        'InvoiceRows' => ['class' => FortnoxInvoiceRow::class, 'attribute' => 'rows'],
    ];
    protected $fortnox_fields = [
        'document_number',
        'customer_number',
        'due_date',
        'invoice_date',
        'invoice_type',
        'payment_way',
        'print_template',
    ];
    protected $completeFortnoxItems = true;
    protected $guarded=[];
    protected $with=['rows'];

    public function rows()
    {
        return $this->hasMany(FortnoxInvoiceRow::class, 'fortnox_invoice_id', 'id');
    }

    public function getPDF()
    {
        $fn = App::make('App\Models\Fortnox\Fortnox');
        return $fn->makeCall('get', 'invoices/'.$this->document_number.'/preview');
    }

    public function makeCardPaid()
    {
        $this->invoice_type = 'CASHINVOICE';
        $this->print_template = 'cash';
        $this->payment_way = 'CARD';
        return $this;
    }

    public function makeCashPaid()
    {
        $this->invoice_type = 'CASHINVOICE';
        $this->print_template = 'cash';
        $this->payment_way = 'CASH';
        return $this;
    }

    public function getStatusAttribute()
    {
        if ($this->cancelled) {
            return 'Makulerad';
        }
        if ($this->due_date < now() && $this->balance > 0) {
            return 'Förfallen';
        }
        if ($this->balance > 0) {
            return 'Obetald';
        }
        if ($this->balance == 0) {
            return 'Betald';
        }
        if ($this->balance < 0) {
            return 'Krediteras';
        }
    }

    public function getRowClassAttribute()
    {
        switch($this->getStatusAttribute()) {
            case 'Förfallen':
                return 'table-danger';
                break;
            case 'Obetald':
                return 'table-warning';
                break;

            default:
                return '';
                break;
        }
    }
}
