<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'learning_moduls';

    protected $fillable = [
        'instructor_id',
        'name',
        'description',
        'is_active'
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function modulDetails()
    {
        return $this->hasMany(ModulDetail::class, 'learning_modul_id', 'id');
    }
}
