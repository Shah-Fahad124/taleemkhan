<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedPaper extends Model
{
    protected $fillable = [
        'district_id',
        'grade_id',
        'subject_id',
        'paper_type',
        'month',
        'semester',
        'version',
        'question_ids',
        'total_marks',
        'academic_year',
    ];

    protected $casts = [
        'question_ids' => 'array',
    ];

    public function grade()
{
    return $this->belongsTo(Grade::class, 'grade_id');
}

}
