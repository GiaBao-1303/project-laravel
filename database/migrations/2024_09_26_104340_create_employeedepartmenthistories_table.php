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
            $table->integer('BusinessEntityID');
            $table->integer('DepartmentID');
            $table->integer('ShiftID');
            $table->date('StartDate');
            $table->date('EndDate')->nullable();
            $table->dateTime('ModifiedDate')->default(now());
            $table->timestamps();

            $table->primary(['BusinessEntityID', 'DepartmentID', 'ShiftID', 'StartDate']);

            $table->foreign('BusinessEntityID')->references('BusinessEntityID')->on('employees')->onDelete("cascade");
            $table->foreign('DepartmentID')->references('DepartmentID')->on('departments')->onDelete("cascade");
            $table->foreign('ShiftID')->references('ShiftID')->on('shifts')->onDelete("cascade");
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
