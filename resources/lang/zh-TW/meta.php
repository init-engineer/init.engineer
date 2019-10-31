<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Meta Language Lines
    |--------------------------------------------------------------------------
    */

    'og' => [
        'type' => env('META_OG_TYPE', 'website'),
        'title' => env('META_OG_TITLE'),
        'image' => env('META_OG_IMAGE'),
        'description' => env('META_OG_DESCRIPTION'),
        'keyword' => env('META_OG_KEYWORD'),
    ],

    'facebook' => [
        'app_id' => env('META_FACEBOOK_APP_ID'),
    ],

    'google' => [
        'site_verification' => env('META_GOOGLE_SITE_VERIFICATION'),
    ],

    'twitter' => [
        'card' => 'summary_large_image',
        'site' => '@',
    ],
];
