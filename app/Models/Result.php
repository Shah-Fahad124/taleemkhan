<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\GeneratedPaper;

class Result extends Model
{
    protected $guarded = [];


    protected $casts = [
        'marks' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function paper()
    {
        return $this->belongsTo(GeneratedPaper::class, 'paper_id');
    }
}
