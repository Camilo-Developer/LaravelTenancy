<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\App\ProfileController;
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

    Route::get('/app/admin/dashboard',[DashboardController::class,'index'])->middleware('can:app.admin.dashboard')->name('app.admin.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/app/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/app/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/app/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/app_auth.php';
});
