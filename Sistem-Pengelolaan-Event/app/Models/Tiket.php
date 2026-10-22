<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tiket';

    public $timestamps = false;

    protected $fillable = [
        'tipe_tiket',
        'harga_tiket',
        'kuota',
        'fasilitas',
    ];
}
