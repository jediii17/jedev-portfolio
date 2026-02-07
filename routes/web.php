<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills.index');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects.index');
Route::get('/certifications', [PortfolioController::class, 'certifications'])->name('certifications.index');

// Chatbot API
Route::post('/api/chat', [ChatController::class, 'chat'])->name('chat.send')->middleware('throttle:60,1');
Route::get('/api/chat/reply', [ChatController::class, 'getAdminReply'])->name('chat.reply')->middleware('throttle:60,1');
