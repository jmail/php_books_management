<?php

namespace App\Providers;

use \Illuminate\Support\ServiceProvider;

/**
 * Class HelperServiceProvider
 * @package App\Providers
 */
class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (glob(dirname(dirname(__FILE__)) . '/Helpers/*.php') as $filename) {
            require_once($filename);
        }
    }
}
