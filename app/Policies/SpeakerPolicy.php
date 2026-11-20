<?php

namespace App\Policies;

use App\Models\Speaker;
use App\Models\User;

class SpeakerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin', 'panitia');
    }

    public function view(User $user, Speaker $speaker): bool
    {
        return $user->hasRole('admin', 'panitia');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'panitia');
    }

    public function update(User $user, Speaker $speaker): bool
    {
        return $user->hasRole('admin', 'panitia');
    }

    public function delete(User $user, Speaker $speaker): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Speaker $speaker): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Speaker $speaker): bool
    {
        return $user->hasRole('admin');
    }
}