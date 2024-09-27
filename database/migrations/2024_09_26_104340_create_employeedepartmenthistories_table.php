<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employeedepartmenthistories', function (Blueprint $table) {
            $table->integer('BusinessEntityID')->nullable();
            $table->integer('DepartmentID')->nullable();
            $table->integer('ShiftID')->nullable();
            $table->date('StartDate')->nullable();
            $table->date('EndDate');
            $table->dateTime('ModifiedDate');
            $table->timestamps();

            $table->primary(['BusinessEntityID', 'DepartmentID', 'ShiftID', 'StartDate']);
        
            $table->foreign('BusinessEntityID')->references('BusinessEntityID')->on('employees');
            $table->foreign('DepartmentID')->references('DepartmentID')->on('departments');
            $table->foreign('ShiftID')->references('ShiftID')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeedepartmenthistories');
    }
};
