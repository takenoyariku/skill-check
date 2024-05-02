<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Diary\GetDiary;
use App\Services\Diary\CreateDiary;
use App\Services\Diary\UpdateDiary;

class DiaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->bind('get_diary', GetDiary::class);
      $this->app->bind('create_diary', CreateDiary::class);
      $this->app->bind('update_diary', UpdateDiary::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}