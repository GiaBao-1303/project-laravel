<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
//----------------------------------------ADmin-------------------------------------------
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// ---------------------------------------- Employees ----------------------------------------
Route::post('/staff', [StaffController::class, 'createStaff'])
    ->name("createStaff")
    ->middleware("validate.create.staff");

Route::put("/staffs/{staffId}/edit", [StaffController::class, "staffEdit"])
    ->name("staffEdit")
    ->middleware("validate.edit.staff");

Route::delete("/staffs/{staffId}/delete", [StaffController::class, "staffDelete"])
    ->name("staffDelete");

// Page

Route::get("/staff", [StaffController::class, 'createStaffPage'])
    ->name("createStaffPage");

Route::get("/staffs/{staffId}/edit", [StaffController::class, "staffEditPage"])
    ->name("staffEditPage");

Route::get("/staffs/{staffId}", [StaffController::class, "staffPageDetail"])
    ->name("staffPageDetail");

Route::get("/staffs", [StaffController::class, "getAndSearch"])
    ->name("getAndSearch");

// ---------------------------------------- Departments ----------------------------------------

Route::post("/department", [DepartmentController::class, "createDepartment"])
    ->name("createDepartment")
    ->middleware("validate.department");

Route::put("/departments/{departmentId}/edit", [DepartmentController::class, "editDepartment"])
    ->name("editDepartment")
    ->middleware("validate.department");

Route::delete("/departments/{departmentId}/delete", [DepartmentController::class, "departmentDelete"])
    ->name("departmentDelete");

// Page
Route::get("/department", [DepartmentController::class, "createDepartmentPage"])
    ->name("createDepartmentPage");

Route::get('/departments', [DepartmentController::class, "getAllDepartments"])
    ->name("getAllDepartments");

Route::get("/departments/{departmentId}", [DepartmentController::class, "StaffInDepartment"])
    ->name("StaffInDepartment");

Route::get("/departments/{departmentId}/edit", [DepartmentController::class, "departmentEditPage"])
    ->name("departmentEditPage");


// ---------------------------------------- Shift ----------------------------------------
Route::post("/shift", [ShiftController::class, "createShift"])
    ->name("createShift")
    ->middleware("validate.shift");

Route::delete('/shifts/{shiftId}/delete', [ShiftController::class, "shiftDelete"])
    ->name("shiftDelete");


Route::put("/shifts/{shiftId}/edit", [ShiftController::class, "editShift"])
    ->name("editShift")
    ->middleware("validate.shift");


// Page
Route::get("/shift", [ShiftController::class, "ShiftCreatingPage"])
    ->name("ShiftCreatingPage");

Route::get("/shifts", [ShiftController::class, "getAllShiftPage"])
    ->name("getAllShiftPage");

Route::get("/shifts/{shiftId}/edit", [ShiftController::class, "editShiftPage"])
    ->name("editShiftPage");

Route::get("/shifts/{shiftId}", [ShiftController::class, "shiftDetails"])
    ->name("shiftDetails");
