<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZKTecoController;
use App\Http\Controllers\MailTestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('zkteco', [ZKTecoController::class, 'index'])->name('zkteco');

Route::get('sendMail', [MailTestController::class, 'sendMail'])->name('sendMail');