<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChecklistController;
use App\Http\Controllers\Api\UserController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('checklist/{id}', [ChecklistController::class, 'show']);
Route::get('checklist/', [ChecklistController::class, 'index']);
Route::get('checklist/{id}/actions', [ChecklistController::class, 'getChecklistWithActions']);
Route::post('/register', [UserController::class, 'register']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('checklist/create', [ChecklistController::class, 'store']);
    Route::post('checklist/{id}/delete', [ChecklistController::class, 'destroy']);
    Route::post('/checklist/action/{id}/toggle-action-status', [ChecklistController::class, 'toggleActionStatus']);
    Route::post('checklist/{id}/action/add', [ChecklistController::class, 'addAction']);
});

