<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Grade;

class ItemBank extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationships
     */

    // Each item belongs to a Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Each item belongs to a Grade
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
