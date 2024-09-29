<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'BusinessEntityID';

    protected $fillable = [
        'NationalIDNumber',
        'LoginID',
        'OrganizationNode',
        'OrganizationLevel',
        'JobTitle',
        'BirthDate',
        'MaritalStatus',
        'Gender',
        'HireDate',
        'VacationHours',
        'SickLeaveHours',
        'ModifiedDate'
    ];

    public function histories()
    {
        return $this->hasMany(History::class, 'BusinessEntityID');
    }

    public function departments()
    {
        return $this->hasManyThrough(
            Department::class,
            History::class,
            'BusinessEntityID',
            'DepartmentID',
            'BusinessEntityID',
            'DepartmentID'
        );
    }

    public function shifts()
    {
        return $this->hasManyThrough(
            shift::class,
            History::class,
            'BusinessEntityID',
            'ShiftID',
            'BusinessEntityID',
            'ShiftID'
        );
    }
}
