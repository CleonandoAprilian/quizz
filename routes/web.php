<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (replacing Auth::routes())
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/leaderboard', [DashboardController::class, 'leaderboard'])->name('dashboard.leaderboard');
    Route::get('/dashboard/history', [DashboardController::class, 'history'])->name('dashboard.history');
    
    // Quiz Routes
    Route::get('/dashboard/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/dashboard/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/dashboard/quizzes/{id}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/dashboard/quiz-result/{id}', [QuizController::class, 'result'])->name('quiz.result');
});