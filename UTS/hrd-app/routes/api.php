<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/employees', [EmployeesController::class, 'index']);
    Route::post('/employees', [EmployeesController::class, 'store']);
    Route::get('/employees/{id}', [EmployeesController::class, 'show']);
    Route::put('/employees/{id}', [EmployeesController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);
    Route::get('/employees/search/{name}', [EmployeesController::class, 'search']);
    Route::get('/employees/status/active', [EmployeesController::class, 'getActive']);
    Route::get('/employees/status/inactive', [EmployeesController::class, 'getInactive']);
    Route::get('/employees/status/terminated', [EmployeesController::class, 'getTerminated']);
});

