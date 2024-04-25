<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;

Route::get('/', [DiaryController::class, 'index'])->name('index');

Route::resource('diary', DiaryController::class)->only([
  'create',
  'store',
  'update',
  'edit',
  'destroy',
]);
