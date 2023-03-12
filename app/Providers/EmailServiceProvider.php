<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = array(
            'driver'     => 'sendmail',
            'host'       => env('MAIL_HOST'),
            'port'       => env('MAIL_PORT'),
            'from'       => array('address' => env('MAIL_FROM_ADDRESS'), 'name' => env('MAIL_FROM_ADDRESS')),
            'encryption' => env('MAIL_ENCRYPTION'),
            'username'   => env('MAIL_USERNAME'),
            'password'   => env('MAIL_PASSWORD'),
            'sendmail'   => '/usr/sbin/sendmail -bs',
            'pretend'    => false,
        );
        Config::set('mail', $config);
    }
}
