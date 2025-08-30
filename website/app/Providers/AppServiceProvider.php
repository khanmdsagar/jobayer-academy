<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        if (!app()->runningInConsole()) {
            $site_data   = DB::table('settings')->get();
            $social_link = DB::table('social_link')->get();
            $why_we_us   = DB::table('why_we_us')->get();
            $page        = DB::table('page')->get();
            View::share(['site_data'=> $site_data, 'social_link'=> $social_link, 'why_we_us'=> $why_we_us, 'page'=> $page]);
        }
    }
}
