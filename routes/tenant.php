<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Redirect\RedirectController;
use App\Http\Controllers\App\Admin\Dashboard\DashboardController;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('/redirect-two',[RedirectController::class, 'dashboardApp']);

    Route::middleware('appuserauth')->prefix('app/admin')->group(function () {
        Route::get('/dashboard',[DashboardController::class,'index'])->name('app.admin.dashboard');
    });

    Route::get('/app/login',[DashboardController::class,'login'])->name('app.admin.login');
    Route::post('/app/login/store',[DashboardController::class,'store'])->name('app.admin.login.store');
    Route::get('/app/logout',[DashboardController::class,'logout'])->name('app.admin.logout');

});
