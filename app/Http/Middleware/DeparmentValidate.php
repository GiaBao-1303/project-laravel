<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeparmentValidate
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
                "Name" => "required",
                "GroupName" => "required"
            ]);
            return $next($request);
        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        } catch (Exception $exception) {
            return redirect()->back()->with("Error", "Internal Server Error");
        }
    }
}
