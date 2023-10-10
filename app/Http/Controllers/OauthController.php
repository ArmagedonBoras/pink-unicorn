<?php

namespace App\Http\Controllers;

use App\Models\OauthProvider;
use Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OauthController extends Controller
{
    public function redirectToProvider($provider)
    {
        abort_if(!array_key_exists($provider, OauthProvider::$providers), 404);

        return Socialite::driver($provider)->redirect();
    }

    public function callbackFromProvider($provider)
    {
        if (auth()->user()) {
            // register callback
            $oauthUser = Socialite::driver($provider)->user();
            OauthProvider::create([
                'user_id' => auth()->id(),
                'provider' => $provider,
                'provider_id' => $oauthUser->getId(),
            ]);
            return redirect()->route('mypage.show');
        } else {
            // log in user
            $user = null;
            $provider = Str::lower($provider);
            abort_if(!array_key_exists($provider, OauthProvider::$providers), 404);
            $oauthUser = Socialite::driver($provider)->user();

            $oauthProvider = OauthProvider::where('provider', $provider)
                ->where('provider_id', $oauthUser->getId())
                ->with('user')
                ->first();

            if ($oauthProvider?->user) {
                auth()->login($oauthProvider->user, true);
                return redirect('/dashboard');
            }
            abort(403, 'Kunde inte logga in via ' . $provider . '. Har du kopplat din användare i dina inställningar?');
        }

    }

    public function destroy($provider)
    {
        abort_if(!auth()->id(), 403);
        $p = OauthProvider::where('provider', $provider)->where('user_id', auth()->id())->first();
        $p?->delete();
        return redirect()->route('mypage.show');
    }

}
