<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Auth::class, function ($app) {
            $firebaseCredentialsPath = config('firebase.credentials');
            
            if (!file_exists($firebaseCredentialsPath)) {
                throw new \Exception('Firebase credentials file not found at ' . $firebaseCredentialsPath);
            }
    
            return (new Factory)
                ->withServiceAccount($firebaseCredentialsPath)
                ->createAuth();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
