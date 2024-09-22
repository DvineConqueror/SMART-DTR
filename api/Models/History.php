<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'duty_id',
        'date_completed',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function duty()
    {
        return $this->belongsTo(Duty::class);
    }
}