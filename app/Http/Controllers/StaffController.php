<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
    public function staffPage()
    {

        return view("staffs.CreateStaff", ["formInputs" => $this->formInput]);
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

    public function getAllStaff()
    {
        $emloyees = Employee::all();

        return view("staffs.index", compact('emloyees'));
    }

    // --------------------------------------- POST Requests --------------------------------

    public function createStaff(Request $req)
    {
        try {
            $data = $req->except("__token");
            Employee::create($data);

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
