<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController; 
use App\Http\Controllers\AuthController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/employees', [EmployeesController::class, 'index']); // Mengakses semua pegawai
    Route::post('/employees', [EmployeesController::class, 'store']); // Menambahkan pegawai
    Route::get('/employees/{id}', [EmployeesController::class, 'show']); // Menampilkan detail pegawai
    Route::put('/employees/{id}', [EmployeesController::class, 'update']); // Memperbarui data pegawai
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']); // Menghapus data pegawai
    Route::get('/employees/search/{name}', [EmployeesController::class, 'search']); // Mencari pegawai berdasarkan nama
    Route::get('/employees/status/active', [EmployeesController::class, 'getActive']); // Menampilkan pegawai aktif
    Route::get('/employees/status/inactive', [EmployeesController::class, 'getInactive']); // Menampilkan pegawai tidak aktif
    Route::get('/employees/status/terminated', [EmployeesController::class, 'getTerminated']); // Menampilkan pegawai yang dihentikan
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
