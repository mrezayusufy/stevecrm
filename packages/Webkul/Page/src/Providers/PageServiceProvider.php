<?php

namespace Webkul\Page\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Webkul\Page\Contracts\Page as PageContract;
use Webkul\Page\Repositories\PageRepository as PageRepository;
class PageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PageContract::class, PageRepository::class);
    }

}