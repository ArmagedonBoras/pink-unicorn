<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        /**
         * User Object
         *
         * @var App\Models\User
         */
        $user = $event->user;
        $user->last_login_at = $user->login_at;
        $user->login_at = Carbon::now();
        $user->save();
    }
}
