<?php

use App\Livewire\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Livewire\Members\ShowPage;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PermissionController;

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

Route::get('/', function () {
    return (Auth::check()) ? redirect(settings('landing_start', '/armagedon')) : redirect(settings('landing_login', '/armagedon'));
});

Route::get('/home', function () {
    return (Auth::check()) ? redirect(settings('landing_login', '/armagedon')) : redirect(settings('landing_login', '/armagedon'));
});

Route::get('/dashboard', function () {
    return (Auth::check()) ? redirect(settings('landing_login', '/armagedon')) : redirect(settings('landing_login', '/armagedon'));
});

Route::get('/users/mypage', ShowPage::class)->name('mypage.show');
Route::view('/calendar', 'events.calendar')->name('calendar');
Route::post('/roles/{role}/members', [RoleMembersController::class, 'store'])->name('rolemembers.store');
Route::delete('/roles/{role}/members/{user}', [RoleMembersController::class, 'destroy'])->name('rolemembers.destroy');
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

Route::get('/{parent}/{link}', [PageController::class, 'showParent']);
Route::get('/{link}', [PageController::class, 'show']);
