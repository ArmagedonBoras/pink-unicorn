<?php

namespace App\Traits;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

trait HasGate
{
    public function isAuthorized(): bool
    {
        switch ($this->gate) {
            case '':
                return true;
                break;
            case 'guest':
                if (!Auth::check()) {
                    return true;
                }
                break;
            case 'user':
                if (Auth::check()) {
                    return true;
                }
                break;
            case 'hidden':
                return false;
                break;
            default:
                if (Auth::check() && Role::where('name', $this->gate)->exists()) {
                    /**
                     * @var $user App\Models\User
                     */
                    $user = Auth::user();
                    if ($user->hasRole($this->gate)) {
                        return true;
                    }
                    break;
                }
                if (Gate::allows($this->gate)) {
                    return true;
                }
                break;
        }
        return false;
    }
}
