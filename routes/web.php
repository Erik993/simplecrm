<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/task', [TaskController::class, 'index']);
