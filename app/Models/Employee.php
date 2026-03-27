<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'department',
        'designation',
        'join_date',
        'birth_date',
        'salary',
        'status',
    ];

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}

