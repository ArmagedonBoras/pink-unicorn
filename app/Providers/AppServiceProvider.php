<?php

namespace App\Providers;

use App\Models\Fortnox\Fortnox;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Blade::directive('tagcache', function ($expression) {
            return "<?php
                \$__cache_directive_arguments = [{$expression}];
                if (count(\$__cache_directive_arguments) === 3) {
                    [\$__cache_directive_tag, \$__cache_directive_key, \$__cache_directive_ttl] = \$__cache_directive_arguments;
                } else {
                    [\$__cache_directive_tag, \$__cache_directive_key] = \$__cache_directive_arguments;
                    \$__cache_directive_ttl = config('blade-cache-directive.ttl');
                }
                if (\Illuminate\Support\Facades\Cache::tags(\$__cache_directive_tag)->has(\$__cache_directive_key)) {
                    echo \Illuminate\Support\Facades\Cache::tags(\$__cache_directive_tag)->get(\$__cache_directive_key);
                } else {
                    \$__cache_directive_buffering = true;
                    ob_start();
            ?>";
        });

        Blade::directive('endtagcache', function () {
            return "<?php
                    \$__cache_directive_buffer = ob_get_clean();
                    \Illuminate\Support\Facades\Cache::tags(\$__cache_directive_tag)->put(\$__cache_directive_key, \$__cache_directive_buffer, \$__cache_directive_ttl);
                    echo \$__cache_directive_buffer;
                    unset(\$__cache_directive_key, \$__cache_directive_ttl, \$__cache_directive_buffer, \$__cache_directive_buffering, \$__cache_directive_arguments);
                }
            ?>";
        });
    }

    public function provides()
    {
        return [Fortnox::class,];
    }

}
