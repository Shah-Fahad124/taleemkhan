<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeFormat extends Model
{
    protected $fillable = [
        'school_id',
        'class_id',
        'monthly_fee',
        'transport_fee',
        'computer_fee',
        'total_fee',
    ];

    public function class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
}
