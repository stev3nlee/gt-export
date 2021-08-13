<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use App\Models\Metadata;

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
        //$metadata = Metadata::where('link',url()->current())->first();
        //view()->share('metadata', $metadata);
    }
}
