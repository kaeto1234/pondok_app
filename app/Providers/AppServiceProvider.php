<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\YayasanInfo;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share data footer ke semua view
        View::composer('*', function ($view) {
            $yayasan = YayasanInfo::first();
            $quickLinks = Menu::whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
            
            $view->with(compact('yayasan', 'quickLinks'));
        });
    }

    public function register()
    {
        //
    }
}