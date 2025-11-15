<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    // A student belongs to a school
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // A student belongs to a grade
    public function grade() { return $this->belongsTo(Grade::class); }
    public function admission() { return $this->hasOne(Admission::class); }
}
