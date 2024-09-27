<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StaffController extends Controller
{
    public function __construct() {}

    public function createStaff(Request $req) {
        $data = $req->all();
        return view("CreateStaff");
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

        return view("CreateStaff", ["formInputs" => $formInput]);
    }
}
