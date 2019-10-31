<?php

/*
 * This file is part of Laravel Plurk.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    */
    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Plurk Connections
    |--------------------------------------------------------------------------
    */
    'connections' => [
        'main' => [
            'client_id' => env('PLURK_CLIENT_ID', 'PLURK_CLIENT_ID'),
            'client_secret' => env('PLURK_CLIENT_SECRET', 'PLURK_CLIENT_SECRET'),
            'default_toekn' => env('PLURK_TOKEN', 'PLURK_TOKEN'),
            'default_token_secret' => env('PLURK_TOKEN_SECRET', 'PLURK_TOKEN_SECRET'),
            'default_social_url' => env('PLURK_SOCIAL_URL', 'https://plurk.com/'),
        ],
    ],
];
