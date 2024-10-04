<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'subject',
        'room',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    // Relationship to other tables
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    //Scope to get upcoming duties/Check all the upcoming duties
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'pending')->where('date', '>=', now());
    }

    //Scope to get completed duties/Check all the completed duties
    public function scopeCompleted($query)
    {
        return $query->where('status', 'finished')
            ->orWhere(function ($query) {
                //Check if the date is finished even if the status is pending(aayusin pa)
                $query->where('status', 'pending')->where('date', '<', now());
            });
    }
}
