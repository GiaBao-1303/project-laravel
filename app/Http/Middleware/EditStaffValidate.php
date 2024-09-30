<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class EditStaffValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $request->validate([
                "NationalIDNumber" => "required",
                "LoginID" => "required",
                "OrganizationNode" => "required",
                "OrganizationLevel" => ["required", "integer"],
                "JobTitle" => ["required", "max:50"],
                "Gender" => ["required", "max:1"],
                "BirthDate" => ["required", "date"],
                "MaritalStatus" => ["required", "max:1"],
                "HireDate" => ["required", "date"],
                "VacationHours" => ["required", "integer"],
                "SickLeaveHours" => ["required", "integer"],
            ]);

            return $next($request);
        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with("Error", "Internal Server Error");
        }
    }
}
