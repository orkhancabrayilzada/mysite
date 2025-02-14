<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontController::class,'index'])->name('home');


Route::get('/admin2', function () {
    return view('layout.admin');
});


Route::prefix('admin')->group(function () {
    require base_path('app/Modules/Admin/About/route.php');
    require base_path('app/Modules/Admin/Contact/route.php');
    require base_path('app/Modules/Admin/Dashboard/route.php');
    require base_path('app/Modules/Admin/Home/route.php');
    require base_path('app/Modules/Admin/Portfolio/route.php');
    require base_path('app/Modules/Admin/Questions/route.php');
    require base_path('app/Modules/Admin/References/route.php');
    require base_path('app/Modules/Admin/Resume/route.php');
    require base_path('app/Modules/Admin/Services/route.php');
    require base_path('app/Modules/Admin/Settings/route.php');
});
