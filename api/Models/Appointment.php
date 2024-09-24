<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'date',
        'time',
        'subject',
        'room',
        'students',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
