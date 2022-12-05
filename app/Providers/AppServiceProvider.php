<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Folder;

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
        view()->composer('*', function($view){
        $folders = Folder::where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('id', 'DESC')
        ->get();
        $view->with('folders', $folders);
        });
    }
}
