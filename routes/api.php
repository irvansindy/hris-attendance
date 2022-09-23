<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ZKTecoController;
use App\Http\Controllers\API\ApiHrisController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    
    return $request->user();
});
Route::get('getAttendance', [ApiHrisController::class, 'getAttendance'])->name('getAttendance');
Route::post('storeAttendanceKarawang', [ApiHrisController::class, 'storeAttendanceKarawang'])->name('storeAttendanceKarawang');
Route::post('storeAttendanceKarawang2', [ApiHrisController::class, 'storeAttendanceKarawang2'])->name('storeAttendanceKarawang2');
Route::post('storeAttendanceHO', [ApiHrisController::class, 'storeAttendanceHO'])->name('storeAttendanceHO');
Route::post('storeAttendanceT8', [ApiHrisController::class, 'storeAttendanceT8'])->name('storeAttendanceT8');
Route::post('storeAttendancCimanggisSecurityKanan', [ApiHrisController::class, 'storeAttendancCimanggisSecurityKanan'])->name('storeAttendancCimanggisSecurityKanan');
Route::get('all', [ApiHrisController::class, 'all'])->name('all');
