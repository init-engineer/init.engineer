<?php

/*
 * This file is part of Social Cards.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Facebook Connections
    |--------------------------------------------------------------------------
    */
    'facebook' => [
        'primary' => [
            'create_post' => env('FACEBOOK_PRIMARY_CREATE_POST', false),
            'user_id' => env('FACEBOOK_PRIMARY_USER_ID', 'FACEBOOK_PRIMARY_USER_ID'),
            'social_url' => env('FACEBOOK_PRIMARY_SOCIAL_URL', 'https://www.facebook.com/'),
            'post_path' => env('FACEBOOK_PRIMARY_POST_PATH', 'https://www.facebook.com/'),
        ],

        'secondary' => [
            'create_post' => env('FACEBOOK_SECONDARY_CREATE_POST', false),
            'user_id' => env('FACEBOOK_SECONDARY_USER_ID', 'FACEBOOK_SECONDARY_USER_ID'),
            'social_url' => env('FACEBOOK_SECONDARY_SOCIAL_URL', 'https://www.facebook.com/'),
            'post_path' => env('FACEBOOK_SECONDARY_POST_PATH', 'https://www.facebook.com/'),
        ],
    ],

    'twitter' => [
        'primary' => [
            'create_post' => env('TWITTER_CREATE_POST', false),
            'user_id' => env('TWITTER_USER_ID', 'TWITTER_USER_ID'),
            'social_url' => env('TWITTER_SOCIAL_URL', 'https://twitter.com/'),
            'post_path' => env('TWITTER_POST_PATH', 'https://twitter.com/'),
        ],
    ],

    'plurk' => [
        'primary' => [
            'create_post' => env('PLURK_CREATE_POST', false),
            'user_id' => env('PLURK_USER_ID', 'PLURK_USER_ID'),
            'social_url' => env('PLURK_SOCIAL_URL', 'https://plurk.com/'),
            'post_path' => env('PLURK_POST_PATH', 'https://www.plurk.com/p/'),
        ],
    ],
];
