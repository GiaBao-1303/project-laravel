<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\shift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShiftController
{

    public $formInputs;
    public function __construct()
    {
        $this->formInputs = [
            "Name",
            "StartTime",
            "EndTime"
        ];
    }


    // --------------------------------------- GET Requests --------------------------------
    public function ShiftCreatingPage()
    {
        $formInputs = $this->formInputs;

        return view("shifts.CreateShift", compact("formInputs"));
    }

    public function getAllShiftPage()
    {
        $shifts = shift::all();

        return view("shifts.index", compact("shifts"));
    }

    public function editShiftPage($shiftId)
    {
        try {
            $shift = shift::where(["ShiftID" => $shiftId])->firstOrFail();

            return view("shifts.EditShift", compact("shift"));
        } catch (Exception $error) {
        }
    }

    public function shiftDetails($shiftId)
    {
        $shift = shift::where(["ShiftID" => $shiftId])->first();
        if (!$shift) abort(404);
        $emloyees = Employee::whereHas("shifts", function ($query) use ($shiftId) {
            $query->where("employeedepartmenthistories.ShiftID", $shiftId);
        })->get();

        return view("shifts.ShiftDetail", compact("shift", "emloyees"));
    }

    // --------------------------------------- POST Requests --------------------------------

    public function createShift(Request $req)
    {
        try {
            $data = $req->except("__token");
            shift::create($data);

            return redirect()->to("/shifts");
        } catch (Exception $e) {
            Log::error("Error", [$e]);
            return redirect()->back()->with("Error", "Internal Server Error");
        }
    }

    // --------------------------------------- PUT Requests --------------------------------
    public function editShift($shiftId, Request $req)
    {
        try {
            $data = $req->except("__token");
            $shift = shift::where(["ShiftID" => $shiftId])->first();
            if (!$shift) abort(404);
            $data['ModifiedDate'] = now();

            $shift->update($data);

            return redirect()->to("/shifts");
        } catch (Exception $error) {
            Log::error("Error", [$error]);
            return redirect()->back()->withErrors($error)->withInput();
        }
    }

    // --------------------------------------- DELETE Requests --------------------------------
    public function shiftDelete($shiftId)
    {
        try {
            $shift = shift::where(["ShiftID" => $shiftId])->first();
            if (!$shift) return abort(404);
            $shift->delete();

            return redirect()->to("/shifts");
        } catch (Exception $error) {
            Log::error("Error", [$error]);
            return redirect()->back()->withErrors($error)->withInput();
        }
    }
}
