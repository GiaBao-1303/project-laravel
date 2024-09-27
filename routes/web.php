<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// Employees
Route::post('/staff', [StaffController::class, 'createStaff'])
    ->name("createStaff")
    ->middleware("validate.staff.create");

Route::get("/staff", [StaffController::class, 'staffPage'])
    ->name("staffPage");


// Departments

