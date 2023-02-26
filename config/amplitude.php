<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | The driver you want to use to send your data. You can choose from the
    | following list:
    |
    | - amplitude
    | - log
    |
    */
    'driver' => 'amplitude',

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | The API Key of your Amplitude project.
    |
    */
    'api_key' => env('AMPLITUDE_API_KEY')
];
