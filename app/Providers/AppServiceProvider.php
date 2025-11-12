<?php

namespace App\Providers;

use App\Services\Search\DatabaseSearchContract;
use App\Services\Search\LikeDatabaseSearch;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DatabaseSearchContract::class, concrete: function () {
            return new LikeDatabaseSearch();
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
