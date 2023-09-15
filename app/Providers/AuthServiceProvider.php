<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability, $attributes) {
            if ($user->hasRole('admin')) {
                $class = '';
                if (!empty($attributes[0])) {
                    if (is_object($attributes[0])) {
                        $class = $attributes[0]->getTable().'-';
                    }
                    if (is_string($attributes[0])) {
                        $class = Str::of(class_basename($attributes[0]))->plural()->lower().'-';
                    }
                }
                $ability = Str::kebab(str_replace('_', '-', $ability));
                Permission::firstOrCreate(['name' => $class.$ability]);
                //$p = Permission::where('name', $class.$ability)->first();
                //if (null === $p) {
                //    Permission::create(['name' => $class.$ability]);
                //}
                return true;
            }
            return null;
        });
    }
}
