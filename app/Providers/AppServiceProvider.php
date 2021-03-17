<?php

namespace App\Providers;

use App\LogValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        $this->app['request']->server->set('HTTPS', true);
        URL::forceScheme('https');
        // DEVICE
        // $products = \App\Product::orderBy('id', 'desc')->get();
        // $deviceActive = \App\Device::where('status', 1)->first();

        // View::share('products',$products);
        // View::share('deviceActive', $deviceActive);
    }

}
