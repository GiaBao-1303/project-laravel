<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\History;
use App\Models\Shift;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function addStaffToDepartment(Request $req, $departmentId)
    {
        try {
            $businessEntityIds = $req->input('business_entity_ids');
            $department = Department::where(["DepartmentID" => $departmentId])->firstOrFail();

            $filterData = array_filter($businessEntityIds, function ($element) {
                return isset($element['BusinessEntityID']) && $element['ShiftID'] !== null;
            });

            DB::beginTransaction();
            foreach ($filterData as $elem) {
                History::create([
                    "BusinessEntityID" => $elem['BusinessEntityID'],
                    "DepartmentID" => $department->DepartmentID,
                    "ShiftID" => $elem['ShiftID'],
                    "StartDate" => now(),
                    "EndDate" => now(),
                ]);
            }

            DB::commit();
            return redirect()->to("/departments/{$departmentId}/assignment");
        } catch (Exception $e) {
            Log::error("Error", [$e]);
            DB::rollBack();
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

    public function addStaffToDepartmentPage($departmentId)
    {
        try {
            $department = Department::where(["DepartmentID" => $departmentId])->firstOrFail();

            $emloyees = Employee::whereDoesntHave("departments", function ($query) use ($departmentId) {
                $query->where("employeedepartmenthistories.DepartmentID", $departmentId);
            })->get();

            $existEmployees = Employee::whereHas("departments", function ($query) use ($departmentId) {
                $query->where("employeedepartmenthistories.DepartmentID", $departmentId);
            })->get();

            $shifts = Shift::all();

            return view("departments.AddStaffToDepartment", compact("department", "existEmployees", "emloyees", "shifts"));
        } catch (Exception $e) {
            Log::error("Error", [$e]);
            return redirect()->back()->withInput();
        }
    }
}
