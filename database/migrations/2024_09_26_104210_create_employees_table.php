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
        Schema::create('employees', function (Blueprint $table) {
            $table->integer("BusinessEntityID")->autoIncrement();
            $table->string('NationalIDNumber', 255);
            $table->text('LoginID');
            $table->longText('OrganizationNode');
            $table->smallInteger('OrganizationLevel');
            $table->string('JobTitle', 50);
            $table->date('BirthDate');
            $table->char('MaritalStatus', 1);
            $table->char('Gender', 1);
            $table->date('HireDate');
            $table->smallInteger('VacationHours');
            $table->smallInteger('SickLeaveHours');
            $table->dateTime('ModifiedDate')->default(now());

            $table->primary("BusinessEntityID");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
