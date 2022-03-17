<?php

namespace App\Providers;

use App\Services\CommentService;
use App\Services\ICommentService;
use App\Services\IPostService;
use App\Services\PostService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(IPostService::class, PostService::class);
        $this->app->bind(ICommentService::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
