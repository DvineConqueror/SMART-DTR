<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'time',
        'subject',
        'teacher',
        'room',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
