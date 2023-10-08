<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\LogSuccessfulLogin;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use SocialiteProviders\Apple\AppleExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\GitHub\GitHubExtendSocialite;
use SocialiteProviders\Google\GoogleExtendSocialite;
use SocialiteProviders\Reddit\RedditExtendSocialite;
use SocialiteProviders\Discord\DiscordExtendSocialite;
use SocialiteProviders\Twitter\TwitterExtendSocialite;
use SocialiteProviders\Facebook\FacebookExtendSocialite;
use SocialiteProviders\Instagram\InstagramExtendSocialite;
use SocialiteProviders\Microsoft\MicrosoftExtendSocialite;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Apple\AppleExtendSocialite::class . '@handle',
            \SocialiteProviders\Facebook\FacebookExtendSocialite::class . '@handle',
            \SocialiteProviders\GitHub\GitHubExtendSocialite::class . '@handle',
            \SocialiteProviders\Google\GoogleExtendSocialite::class . '@handle',
            \SocialiteProviders\Instagram\InstagramExtendSocialite::class . '@handle',
            \SocialiteProviders\Microsoft\MicrosoftExtendSocialite::class . '@handle',
            \SocialiteProviders\Reddit\RedditExtendSocialite::class . '@handle',
            \SocialiteProviders\Twitter\TwitterExtendSocialite::class . '@handle',
            \SocialiteProviders\Discord\DiscordExtendSocialite::class . '@handle',

        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
