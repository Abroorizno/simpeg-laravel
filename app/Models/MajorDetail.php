<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MajorDetail extends Model
{
    protected $table = 'majors_detail';

    protected $fillable = [
        'majors_id',
        'user_id',
        'is_active'
    ];

    public function majors()
    {
        return $this->belongsTo(Major::class, 'majors_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
