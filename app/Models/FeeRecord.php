<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'student_id',
        'class_id',
        'month',
        'year',
        'total_fee',
        'discount',
        'paid_amount',
        'due_amount',
        'status',
        'remarks',
        'payment_date',
    ];

       protected $casts = [
        'payment_date' => 'datetime', // ensures it's a Carbon instance
    ];

    // Relationship to student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relationship to class/grade
    public function class()
    {
        return $this->belongsTo(\App\Models\Grade::class, 'class_id');
    }
}
