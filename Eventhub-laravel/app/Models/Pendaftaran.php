<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pendaftaran extends Model
{
    protected $table = 'peserta';

    const UPDATED_AT = null;
    
 protected $fillable = ['nama_peserta', 'instansi_kampus', 'nomor_kontak', 'email_aktif'];
}

