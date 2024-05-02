<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Diary\GetDiary;
use App\Services\Diary\CreateDiary;
use App\Services\Diary\UpdateDiary;
use App\Services\Diary\DestroyDiary;

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
      $this->app->bind('destroy_diary', DestroyDiary::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
