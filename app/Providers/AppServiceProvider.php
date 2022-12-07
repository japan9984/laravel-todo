<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Memo;
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

            $memo_model = new Memo();
            $memos = $memo_model->getMyMemo();

            $folder_model = new Folder();
            $folders = $folder_model->getMyFolder();


            $view->with('memos', $memos)->with('folders', $folders);
        });
    }
}
