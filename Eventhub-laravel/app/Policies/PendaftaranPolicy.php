<?php

namespace App\Policies;

use App\Models\Pendaftaran;
use App\Models\User;

class PendaftaranPolicy
{
    /**
     * Apakah user boleh mengubah data ini?
     */
    public function update(User $user, ?Pendaftaran $pendaftaran = null): bool
    {
        // Hanya admin yang diizinkan mengedit
        return $user->hasRole('admin');
    }

    /**
     * Apakah user boleh menghapus data ini?
     */
    public function delete(User $user, ?Pendaftaran $pendaftaran = null): bool
    {
        // Hanya admin yang diizinkan menghapus
        return $user->hasRole('admin');
    }
}