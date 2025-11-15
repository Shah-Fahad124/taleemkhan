<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tehsil extends Model
{
    use HasFactory;

    protected $fillable = ['district_id', 'name'];

    // A tehsil belongs to a district
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // A tehsil has many schools
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
