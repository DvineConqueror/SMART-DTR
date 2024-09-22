<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'school_email',
        'password',
        'student_id',
        'mobile_number',
        'birthdate',
        'year_level',
        'sex',
    ];

    protected $hidden = [
        'password',
    ];
}