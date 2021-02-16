<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Setting;
use App\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pages = [
            'Home' => '/'
        ];

        $newPages = Page::all();
        foreach($newPages as $values){
            $pages[$values->title] = $values->slug;
        }

        $newSettings = [];
        $settings = Setting::all();
        foreach($settings as $values){
            $newSettings[$values->name] = $values->content;
        }

        View::share('pages', $pages);
        View::share('settings', $newSettings);
    }
}
