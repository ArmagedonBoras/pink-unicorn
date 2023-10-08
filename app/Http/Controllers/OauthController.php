<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OauthController extends Controller
{
    // provider => icon
    public static $providers = [
//        'apple' => 'apple',
//        'facebook' => 'facebook',
        'github' => 'github',
//        'google' => 'google',
//        'instagram' => 'instagram',
//        'microsoft' => 'microsoft',
//        'reddit' => 'reddit',
        'twitter' => 'twitter',
        'discord' => 'discord',
    ];

    protected $validProviders = [
//        'apple',
//        'facebook',
        'github',
//        'google',
//        'instagram',
//        'microsoft',
//        'reddit',
        'twitter',
        'discord',
    ];

    public function redirectToProvider($provider)
    {
        abort_if(!\in_array($provider, $this->validProviders), 404);
        return Socialite::driver($provider)->redirect();
    }

    public function callbackFromProvider($provider)
    {
        $user = null;
        abort_if(!\in_array($provider, $this->validProviders), 404);
        $oauthUser = Socialite::driver($provider)->user();

        $provider = DB::table('oauth_providers')
            ->where('provider', $provider)
            ->where('provider_id', $oauthUser->getId())->get();

        if (count($provider) > 0) {
            $user = User::find($provider[0]->user_id);
        }
        if ($user) {
            auth()->login($user, true);
            return redirect('/dashboard');
        }
        abort(403, 'Kunde inte logga in användaren via ' . $provider . '. Har du kopplat din användare i dina inställningar?');
        // dd($oauthUser, $provider, $user);

    }
}
