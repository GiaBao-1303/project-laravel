<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\History;
use App\Models\shift;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StaffController extends Controller
{
    public $formInput;
    public function __construct()
    {
        $this->formInput = [
            "NationalIDNumber",
            "LoginID",
            "OrganizationNode",
            "OrganizationLevel",
            "JobTitle",
            "Gender",
            "BirthDate",
            "MaritalStatus",
            "HireDate",
            "VacationHours",
            "SickLeaveHours",
        ];
    }

    // --------------------------------------- GET Requests --------------------------------
    public function createStaffPage()
    {
        $formInputs = $this->formInput;
        $departments = Department::all();
        $shifts = shift::all();

        return view("staffs.CreateStaff", compact('shifts', 'departments', 'formInputs'));
    }

    public function staffPageDetail($staffId)
    {
        $emloyee = Employee::where(["BusinessEntityID" => $staffId])->firstOrFail();

        return view("staffs.StaffDetail", compact('emloyee'));
    }

    public function staffEditPage($staffId)
    {
        $emloyee = Employee::where(["BusinessEntityID" => $staffId])->firstOrFail();

        return view("staffs.StaffEdit", compact('emloyee'));
    }

    public function getAndSearch(Request $req)
    {
        $search = $req->query('search');

        if ($search) {
            $emloyees = Employee::where("LoginID", "LIKE", "%{$search}%")
                ->orWhere("JobTitle", "LIKE", "%{$search}%")
                ->orWhere("BirthDate", "LIKE", "%{$search}%")
                ->orWhere("NationalIDNumber", "LIKE", "%{$search}%")
                ->get();
        } else {
            $emloyees = Employee::all();
        }

        return view("staffs.index", compact('emloyees', 'search'));
    }

    // --------------------------------------- POST Requests --------------------------------

    public function createStaff(Request $req)
    {
        try {
            $data = $req->except("__token", "DepartmentID", "ShiftID");
            $employee = Employee::create($data);
            $departmentId = $req->get("DepartmentID");
            $shiftId = $req->get("ShiftID");

            $department = Department::where(["DepartmentID" => $departmentId])->first();
            $shift = shift::where(["ShiftID" => $shiftId])->first();
            if (!$department || !$shift) abort(404);

            History::create([
                "BusinessEntityID" => $employee->BusinessEntityID,
                "DepartmentID" => $department->DepartmentID,
                "ShiftID" => $shift->ShiftID,
                "StartDate" => now(),
                "EndDate" => now()
            ]);

            return redirect()->to('/staffs');
        } catch (Exception $e) {
            Log::info("Error: ", ["error" => $e]);
            return redirect()->back()->withInput();
        }
    }

    // --------------------------------------- PUT Requests --------------------------------

    public function staffEdit($staffId, Request $req)
    {
        try {
            $data = $req->except(["__token", "ModifiedDate"]);
            $employee = Employee::where("BusinessEntityID", $staffId)->first();
            if (!$employee) abort(404);
            $data['ModifiedDate'] = now();

            $employee->update($data);

            return redirect()->to("/staffs/{$staffId}");
        } catch (Exception $e) {
            Log::error("Error", ["error" => $e]);
            return redirect()->back()->withErrors("Internal server Error")->withInput();
        }
    }

    // --------------------------------------- DELETE Requests --------------------------------

    public function staffDelete($staffId)
    {
        try {
            $employee = Employee::where("BusinessEntityID", $staffId)->first();
            if (!$employee) abort(404);
            $employee->delete();

            return redirect()->to('/staffs');
        } catch (Exception $e) {
            Log::info("Error: ", ["error" => $e]);
            return redirect()->back()->withInput();
        }
    }
}
