<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// Employees

Route::get("/staff", [StaffController::class, 'staffPage'])
    ->name("staffPage");

Route::post('/staff', [StaffController::class, 'createStaff'])
    ->name("createStaff")
    ->middleware("validate.staff.create");

Route::get("/staffs", [StaffController::class, "getAllStaff"])
    ->name("getAllStaff");

// Departments

