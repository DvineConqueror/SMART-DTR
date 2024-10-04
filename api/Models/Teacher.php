<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'teacher_id',
        'mobile_number',
        'date_of_birth',
        'sex',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
