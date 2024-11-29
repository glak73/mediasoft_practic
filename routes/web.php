<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApiTokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddlewware;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/personal-token', [ApiTokenController::class, 'generateToken'])->name('generateToken');
    Route::post('/users/{id}/block', [UserController::class, 'blockUser'])->name('users.block');
    Route::post('/users/{id}/unblock', [UserController::class, 'unblockUser'])->name('users.unblock');
    Route::patch('/users/{id}/assign-admin', [UserController::class, 'assignAdmin'])->name('users.assign-admin');
    Route::patch('/users/{id}/update-checklist-limit', [UserController::class, 'updateChecklistsLimit'])->name('users.update-checklist-limit');
});
Route::resource('checklist', ChecklistController::class);

require __DIR__.'/auth.php';
