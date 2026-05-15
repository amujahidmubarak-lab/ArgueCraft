<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\SimulationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/statistik', [\App\Http\Controllers\DashboardController::class, 'stats'])->name('dashboard.stats');
    
    Route::get('/pembelajaran', [LearningController::class, 'index'])->name('learning.index');
    Route::get('/pembelajaran/{module}', [LearningController::class, 'show'])->name('learning.show');
    Route::post('/pembelajaran/{module}/complete', [LearningController::class, 'complete'])->name('learning.complete');
    
    Route::get('/simulasi', [SimulationController::class, 'setup'])->name('simulation.setup');
    Route::post('/simulasi/start', [SimulationController::class, 'start'])->name('simulation.start');
    Route::get('/simulasi/phase', [SimulationController::class, 'phase'])->name('simulation.phase');
    Route::post('/simulasi/phase', [SimulationController::class, 'submitPhase'])->name('simulation.submitPhase');
    Route::get('/simulasi/result', [SimulationController::class, 'result'])->name('simulation.result');

    // NEW: Interactive Simulation (Chat Style)
    Route::get('/simulasi-interaktif', [\App\Http\Controllers\InteractiveSimulationController::class, 'setup'])->name('simulation.interactive.setup');
    Route::post('/simulasi-interaktif/start', [\App\Http\Controllers\InteractiveSimulationController::class, 'start'])->name('simulation.interactive.start');
    Route::get('/simulasi-interaktif/chat/{session_id}', [\App\Http\Controllers\InteractiveSimulationController::class, 'chat'])->name('simulation.interactive.chat');
    Route::post('/simulasi-interaktif/chat/{session_id}', [\App\Http\Controllers\InteractiveSimulationController::class, 'submit'])->name('simulation.interactive.submit');
    Route::get('/simulasi-interaktif/result/{session_id}', [\App\Http\Controllers\InteractiveSimulationController::class, 'result'])->name('simulation.interactive.result');

    // EXPORT ROUTES
    Route::get('/export/standard/{id}', [\App\Http\Controllers\ExportController::class, 'exportStandard'])->name('export.standard');
    Route::get('/export/interactive/{id}', [\App\Http\Controllers\ExportController::class, 'exportInteractive'])->name('export.interactive');

    // ADMIN PANEL ROUTES
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        
        // Modules
        Route::get('/modules', [\App\Http\Controllers\AdminController::class, 'modules'])->name('modules.index');
        Route::get('/modules/create', [\App\Http\Controllers\AdminController::class, 'moduleCreate'])->name('modules.create');
        Route::post('/modules', [\App\Http\Controllers\AdminController::class, 'moduleStore'])->name('modules.store');
        Route::get('/modules/{module}/edit', [\App\Http\Controllers\AdminController::class, 'moduleEdit'])->name('modules.edit');
        Route::put('/modules/{module}', [\App\Http\Controllers\AdminController::class, 'moduleUpdate'])->name('modules.update');
        Route::delete('/modules/{module}', [\App\Http\Controllers\AdminController::class, 'moduleDestroy'])->name('modules.destroy');

        // Topics
        Route::get('/topics', [\App\Http\Controllers\AdminController::class, 'topics'])->name('topics.index');
        Route::get('/topics/create', [\App\Http\Controllers\AdminController::class, 'topicCreate'])->name('topics.create');
        Route::post('/topics', [\App\Http\Controllers\AdminController::class, 'topicStore'])->name('topics.store');
        Route::get('/topics/{topic}/edit', [\App\Http\Controllers\AdminController::class, 'topicEdit'])->name('topics.edit');
        Route::put('/topics/{topic}', [\App\Http\Controllers\AdminController::class, 'topicUpdate'])->name('topics.update');
        Route::delete('/topics/{topic}', [\App\Http\Controllers\AdminController::class, 'topicDestroy'])->name('topics.destroy');

        // Results
        Route::get('/results', [\App\Http\Controllers\AdminController::class, 'results'])->name('results.index');
        
        // Users
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    });
});
