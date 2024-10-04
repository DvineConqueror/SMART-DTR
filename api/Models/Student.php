<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'student_id',
        'mobile_number',
        'date_of_birth',
        'year_level',
        'sex',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
