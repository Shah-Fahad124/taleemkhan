<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A district has many tehsils
    public function tehsils()
    {
        return $this->hasMany(Tehsil::class);
    }

    // A district has many schools
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
