<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Diary\GetDiary;

class DiaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->bind('get_diary', GetDiary::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
