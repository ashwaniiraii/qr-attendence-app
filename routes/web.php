<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\qrController;
use Illuminate\Support\Facades\Route;

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
Route::get('/register', [AuthController::class, 'RegisterUser'])->name('registerform');
Route::post('/register-form', [AuthController::class, 'StoreUser'])->name('register');
Route::get('/', [AuthController::class, 'LoginPage'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login-page', [AuthController::class, 'Login'])->name('logincheck');

Route::get('/tailwind', function () {
    return view('admin.parent');
});

// Route::get('/dashboard', function () {
//     return view('layout.dashboard')->name('dashboard');
// });

Route::group(['middleware' => ['web', 'AuthMiddleware']], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/generate/{id}', [qrController::class, 'generate'])->name('qr.generate');
    Route::get('/scan/{id}', [qrController::class, 'scan'])->name('qr.scan');
    Route::get('/alluser', [qrController::class, 'alluser'])->name('allusers');
    Route::get('/myattendence', [qrController::class, 'myattendence'])->name('myattendence');
});
