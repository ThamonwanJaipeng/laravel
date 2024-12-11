<?php

use App\Http\Controllers\ChirpController;         //โค้ดนี้นำเข้า Controllers เพื่อควบคุมและจัดการคำร้องขอ HTTP requsets ใน laravel framework
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)       //โค้ดส่วนนี้ใช้สร้างเส้นทางสำหรับ chirps ที่ใช้ ChirpController ให้ใช้งานผ่านแค่ method  index store                                                     //
    ->only(['index', 'store'])                          //และต้องผ่าน middleware เพื่อตรวจสอบการล็อกอิน และ verified ตรวจสอบอีเมลที่ยืนยัน
    ->only(['index', 'store', 'update'])                //ใช้ใน Laravel เพื่อกำหนด method ที่สามารถใช้งานได้ใน Resource Route
    ->middleware(['auth', 'verified']);                 //แสดงรายการของ chirps ที่ผู้ใช้อนุญาต
    ->only(['index', 'store', 'update', 'destroy'])
    require __DIR__.'/auth.php';