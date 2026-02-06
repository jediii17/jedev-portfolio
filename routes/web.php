<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills.index');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects.index');
Route::get('/certifications', [PortfolioController::class, 'certifications'])->name('certifications.index');
