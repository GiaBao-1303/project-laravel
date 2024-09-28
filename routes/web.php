<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// Employees
Route::post('/staff', [StaffController::class, 'createStaff'])
    ->name("createStaff")
    ->middleware("validate.staff");

Route::put("/staffs/{staffId}/edit", [StaffController::class, "staffEdit"])
    ->name("staffEdit")
    ->middleware("validate.staff");

Route::delete("/staffs/{staffId}/delete", [StaffController::class, "staffDelete"])
    ->name("staffDelete");

// Page

Route::get("/staff", [StaffController::class, 'staffPage'])
    ->name("staffPage");

Route::get("/staffs/{staffId}/edit", [StaffController::class, "staffEditPage"])
    ->name("staffEditPage");

Route::get("/staffs/{staffId}", [StaffController::class, "staffPageDetail"])
    ->name("staffPageDetail");

Route::get("/staffs", [StaffController::class, "getAllStaff"])
    ->name("getAllStaff");

// Departments
