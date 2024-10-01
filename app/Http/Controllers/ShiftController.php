<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\History;
use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $shifts = Shift::all();

        return view("shifts.index", compact("shifts"));
    }

    public function editShiftPage($shiftId)
    {
        try {
            $shift = Shift::where(["ShiftID" => $shiftId])->firstOrFail();

            return view("shifts.EditShift", compact("shift"));
        } catch (Exception $error) {
        }
    }

    public function shiftDetails($shiftId)
    {
        $shift = Shift::where(["ShiftID" => $shiftId])->first();
        if (!$shift) abort(404);
        $emloyees = Employee::whereHas("shifts", function ($query) use ($shiftId) {
            $query->where("employeedepartmenthistories.ShiftID", $shiftId);
        })->get();

        return view("shifts.ShiftDetail", compact("shift", "emloyees"));
    }

    public function shiftAssignmentPage($shiftId)
    {
        $shift = Shift::where(["ShiftID" => $shiftId])->firstOrFail();

        $employeesAlreadyAssign = Employee::whereHas("shifts", function ($query) use ($shiftId) {
            $query->where("employeedepartmenthistories.ShiftID", $shiftId);
        })->get();

        $emloyees = Employee::whereDoesntHave('shifts', function ($query) use ($shiftId) {
            $query->where('employeedepartmenthistories.ShiftID', $shiftId);
        })->get();

        return view("shifts.Assignment", compact("emloyees", "employeesAlreadyAssign", "shift"));
    }

    // --------------------------------------- POST Requests --------------------------------

    public function createShift(Request $req)
    {
        try {
            $data = $req->except("__token");
            Shift::create($data);

            return redirect()->to("/shifts");
        } catch (Exception $e) {
            Log::error("Error", [$e]);
            return redirect()->back()->with("Error", "Internal Server Error");
        }
    }

    public function assignmentShift($shiftId, Request $req)
    {
        Shift::where(["ShiftID" => $shiftId])->firstOrFail();
        $businessEntityIDs = $req->input('business_entity_ids');

        DB::beginTransaction();
        try {
            foreach ($businessEntityIDs as $businessEntityID) {
                $department = Department::whereHas("employees", function ($query) use ($businessEntityID) {
                    $query->where("employeedepartmenthistories.BusinessEntityID", $businessEntityID);
                })->first();

                if (!$department) throw new Exception("Người dùng chưa có phòng ban", 401);

                History::create([
                    "BusinessEntityID" => $businessEntityID,
                    "DepartmentID" => $department->DepartmentID,
                    "ShiftID" => $shiftId,
                    "StartDate" => now(),
                    "EndDate" => now(),
                ]);
            }
            DB::commit();

            return redirect()->to("/shifts/{$shiftId}/assignment");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error", [$e]);
            if ($e->getCode() === 401) {
                Log::error(401);

                return redirect()->back()->withInput()->withErrors(["DepartmentError" => $e->getMessage()]);
            }

            return redirect()->back()->withInput();
        }
    }

    // --------------------------------------- PUT Requests --------------------------------
    public function editShift($shiftId, Request $req)
    {
        try {
            $data = $req->except("__token");
            $shift = Shift::where(["ShiftID" => $shiftId])->first();
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
            $shift = Shift::where(["ShiftID" => $shiftId])->first();
            if (!$shift) return abort(404);
            $shift->delete();

            return redirect()->to("/shifts");
        } catch (Exception $error) {
            Log::error("Error", [$error]);
            return redirect()->back()->withErrors($error)->withInput();
        }
    }
}
