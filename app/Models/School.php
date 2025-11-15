<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; // for login guard
use Illuminate\Notifications\Notifiable;

class School extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'emis_code',
        'school_name',
        'school_level',
        'district_id',
        'tehsil_id',
        'zone',
        'head_teacher_name',
        'head_teacher_phone',
        'number_of_teachers',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = ['password'];

    // A school belongs to a district
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // A school belongs to a tehsil
    public function tehsil()
    {
        return $this->belongsTo(Tehsil::class);
    }

    // A school has many students
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
