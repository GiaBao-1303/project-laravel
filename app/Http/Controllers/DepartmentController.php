<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DepartmentController
{

    public $formInputs;

    public function __construct()
    {
        $this->formInputs = [
            "Name",
            "GroupName"
        ];
    }

    // --------------------------------------- POST Requests --------------------------------
    public function createDepartment(Request $req)
    {
        try {
            $data = $req->except("__token");
            Department::create($data);

            return redirect()->to("/departments");
        } catch (Exception $e) {
            Log::error("Error: ", ["error" => $e]);
            return redirect()->back()->withInput();
        }
    }

    // --------------------------------------- PUT Requests --------------------------------
    public function editDepartment($departmentId, Request $req)
    {
        try {
            $data = $req->except("__token");
            $department = Department::where(["DepartmentID" => $departmentId])->first();
            if (!$department) abort(404);
            $data['ModifiedDate'] = now();

            $department->update($data);

            return redirect()->to("/departments");
        } catch (Exception $e) {
            Log::error("Error", ["error" => $e]);
            return redirect()->back()->withErrors("Internal server Error")->withInput();
        }
    }

    // --------------------------------------- DELETE Requests --------------------------------

    public function departmentDelete($departmentId)
    {
        try {
            $department = Department::where(["DepartmentID" => $departmentId])->first();
            if (!$department) abort(404);
            $department->delete();

            return redirect()->to('/departments');
        } catch (Exception $e) {
            Log::info("Error: ", ["error" => $e]);
            return redirect()->back()->withInput();
        }
    }

    // --------------------------------------- GET Requests --------------------------------
    public function createDepartmentPage()
    {
        $formInputs = $this->formInputs;
        return view("departments.CreateDeparment", compact("formInputs"));
    }

    public function getAllDepartments()
    {
        $departments = Department::all();
        return view("departments.index", compact("departments"));
    }

    public function StaffInDepartment($departmentId)
    {

        $department = Department::where(["DepartmentID" => $departmentId])->first();
        if (!$department) return abort(404);

        $emloyees = Employee::whereHas('departments', function ($query) use ($departmentId) {
            $query->where('employeedepartmenthistories.DepartmentID', $departmentId);
        })->get();

        return view("departments.DepartmentDetail", compact('emloyees', 'department'));
    }

    public function departmentEditPage($departmentId)
    {
        $department = Department::where(["DepartmentID" => $departmentId])->firstOrFail();
        return view("departments.EditDepartment", compact("department"));
    }
}
