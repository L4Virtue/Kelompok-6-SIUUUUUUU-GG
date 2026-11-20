<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // izinkan admin & panitia kelola/tambah/edit speaker
        Gate::define('kelola-speaker', fn (User $user) => $user->hasRole('admin', 'panitia'));

        // khusus admin saja yang boleh hapus speaker
        Gate::define('hapus-speaker', fn (User $user) => $user->hasRole('admin'));
    }
}
