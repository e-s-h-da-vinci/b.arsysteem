<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class MoneyViewServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // DO NOT EVER EDIT THIS; THIS IS HORRIBLE.
        Blade::directive('euro', function ($expression) {
            return '
                <?php
                    $amount = (float) ' . $expression. ';
                    if ($amount < 0) {
                        echo ("<span class=\'red\'>&euro; " . money_format(\'%!n\', $amount) . "</span>");
                    } else {
                        echo ("&euro; " . money_format(\'%!n\', $amount));
                    }
                ?>';
        });
    }
}
