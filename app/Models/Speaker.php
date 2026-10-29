<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $table = 'speaker';
    public $timestamps = false;
    protected $fillable = [
        'nama_pembicara',
        'keahlian',
        'institusi',
        'portofolio',
    ];
}
