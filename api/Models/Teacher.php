<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'school_email',
        'password',
        'employee_id',
        'mobile_number',
    ];

    protected $hidden = [
        'password',
    ];
}