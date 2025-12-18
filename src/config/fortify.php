<?php

use Laravel\Fortify\Features;

return [

    /*
    |--------------------------------------------------------------------------
    | Fortify Features
    |--------------------------------------------------------------------------
    */

    'features' => [
        Features::registration(),
        Features::login(),
    ],

];
