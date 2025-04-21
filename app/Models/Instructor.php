<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instructors';

    protected $fillable = [
        'majors_id',
        'user_id',
        'title',
        'gender',
        'address',
        'phone',
        'photo',
        'is_active'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function majors()
    {
        return $this->belongsTo(Major::class, 'majors_id', 'id');
    }
}
