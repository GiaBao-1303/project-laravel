<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StaffController extends Controller
{
    public function __construct() {}

    public function createStaff(Request $req) {
        try {
            $data = $req->except("__token");
            Employee::create($data);

            return redirect()->to('/staffs');
        } catch(Exception $e) {
            Log::info("Error: ", ["error"=>$e]);
            return redirect()->back()->withInput();
        }
    }

    public function staffPage() {
        $formInput = [
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

        return view("staffs.CreateStaff", ["formInputs" => $formInput]);
    }

    public function getAllStaff() {

        return view("staffs.index");
    }
}
