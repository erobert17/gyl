<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;

class SendToAllProvider extends ServiceProvider
{
     /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $user = Auth::user();
            if($user != Null){

                $userHintState = DB::table('users')->where('id', $user->id)->pluck('helpBubbleState');
                $HomeEvaulationleads = DB::table('leads')->where(['user_id' => $user->id, 'type' => 'Home Valuation'])->orderBy('date', 'desc')->count();

                
                echo '<pre>';
                var_dump($HomeEvaulationleads);
                echo '</pre>';
               
                $userHintState = $userHintState[0];
                $view->with(['userHintState' => $userHintState, 'HomeEvaulationleads' => $HomeEvaulationleads]);
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
