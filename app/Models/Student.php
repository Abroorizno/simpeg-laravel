<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'majors_id',
        'user_id',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'photo',
        'is_active'
    ];

    public function majors()
    {
        return $this->belongsTo(Major::class, 'majors_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function moduls()
    {
        return $this->hasManyThrough(
            Modul::class,
            Major::class,
            'id', // Foreign key on the majors table
            'majors_id', // Foreign key on the moduls table
            'majors_id', // Local key on the students table
            'id' // Local key on the majors table
        );
    }

    public function modulDetails()
    {
        return $this->hasMany(ModulDetail::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
