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
}
