<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Tenancy\TenancyController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;



Route::get('/dashboard',[DashboardController::class,'index'])->middleware('can:admin.dashboard')->name('admin.dashboard');
Route::resource('/tenencies',TenancyController::class)->names('admin.tenancies');
