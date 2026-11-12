<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; 
use App\Models\User;               

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
    // Mendefinisikan Gate khusus admin
    Gate::define('manage-pendaftaran', function (User $user) {
        return $user->hasRole('admin');
    });
    }
}
