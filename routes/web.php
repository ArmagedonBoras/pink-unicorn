<?php

use App\Livewire\Tv\Tv;
use App\Livewire\Tablet\Tablet;
use App\Livewire\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Livewire\Members\ShowPage;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleMembersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Just to redirect that default paths from jetstream if forgotten some of the settings
Route::get('/', function () {
    return (Auth::check()) ? redirect(settings('landing_start', '/hem')) : redirect(settings('landing_login', '/hem'));
});
Route::get('/home', function () {
    return (Auth::check()) ? redirect(settings('landing_login', '/hem')) : redirect(settings('landing_login', '/hem'));
});
Route::get('/dashboard', function () {
    return (Auth::check()) ? redirect(settings('landing_login', '/hem')) : redirect(settings('landing_login', '/hem'));
});

Route::get('/tablet', Tablet::class);
Route::get('/tv', Tv::class);
Route::get('/anvandare/minsida', ShowPage::class)->name('mypage.show');
Route::view('/kalender', 'events.calendar')->name('calendar');
Route::post('/roller/{role}/medlemmar', [RoleMembersController::class, 'store'])->name('rolemembers.store');
Route::delete('/roller/{role}/medlemmar/{user}', [RoleMembersController::class, 'destroy'])->name('rolemembers.destroy');
Route::resource('evenemang', EventController::class)->names('events');
Route::group(
    ['middleware' => ['role:admin'], 'prefix' => 'admin'],
    function () {
        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

        Route::resources([
            'tags' => TagController::class,
            'users' => UserController::class,
            'roles' => RoleController::class,
            'pages' => PageController::class,
            'permissions' => PermissionController::class,
            'menus' => MenuController::class,
        ]);
    }
);

// For static pages in two levels
Route::get('/{parent}/{link}', [PageController::class, 'showParent']);
Route::get('/{link}', [PageController::class, 'show']);
