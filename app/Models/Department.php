<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;


    protected $table = 'departments';
    protected $primaryKey = 'DepartmentID';

    protected $fillable = [
        "Name",
        "GroupName",
        "ModifiedDate"
    ];

    public function historys()
    {
        return $this->hasMany(History::class, "DepartmentID", "DepartmentID");
    }

    public function employees()
    {
        return $this->hasManyThrough(
            Employee::class,
            History::class,
            "DepartmentID",
            "BusinessEntityID",
            "DepartmentID",
            "BusinessEntityID",
        );
    }
}
