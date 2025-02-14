<?php

namespace App\Modules\admin\Home;
use App\Modules\admin\Home\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('home-admin',[HomeController::class,'index'])->name('admin.home');
Route::post('update-home', [HomeController::class, 'update'])->name('home.update');
