<?php

namespace App\Modules\admin\About;
use App\Modules\admin\About\Controllers\AboutController;
use Illuminate\Support\Facades\Route;


Route::get('about', [AboutController::class,'index'])->name('admin.about');
Route::post('update', [AboutController::class, 'update'])->name('about.update');
