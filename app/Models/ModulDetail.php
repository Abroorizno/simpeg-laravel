<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulDetail extends Model
{
    protected $table = 'learning_modul_details';

    protected $fillable = [
        'learning_modul_id',
        'file_name',
        'file',
        'reference_link'
    ];

    public function moduls()
    {
        return $this->belongsTo(Modul::class, 'learning_modul_id', 'id');
    }
}
