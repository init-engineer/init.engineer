<?php

/*
 * This file is part of Laravel Facebook.
 *
  * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Facebook Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [
        'main' => [
            'app_id' => 'your-app-id',
            'app_secret' => 'your-app-secret',
            'default_graph_version' => 'v2.2',
            //'default_access_token' => null,
        ],
        'primary' => [
            'user_id' => env('FACEBOOK_PRIMARY_USER_ID', 'your-user-id'),
            'app_id' => env('FACEBOOK_PRIMARY_APP_ID', 'your-app-id'),
            'app_secret' => env('FACEBOOK_PRIMARY_APP_SECRET', 'your-app-secret'),
            'default_graph_version' => env('FACEBOOK_PRIMARY_GRAPH_VERSION', null),
            'default_access_token' => env('FACEBOOK_PRIMARY_ACCESS_TOKEN', null),
            'default_social_url' => env('FACEBOOK_PRIMARY_SOCIAL_URL', 'https://facebook.com/'),
        ],
        'secondary' => [
            'user_id' => env('FACEBOOK_SECONDARY_USER_ID', 'your-user-id'),
            'app_id' => env('FACEBOOK_SECONDARY_APP_ID', 'your-app-id'),
            'app_secret' => env('FACEBOOK_SECONDARY_APP_SECRET', 'your-app-secret'),
            'default_graph_version' => env('FACEBOOK_SECONDARY_GRAPH_VERSION', null),
            'default_access_token' => env('FACEBOOK_SECONDARY_ACCESS_TOKEN', null),
            'default_social_url' => env('FACEBOOK_SECONDARY_SOCIAL_URL', 'https://facebook.com/'),
        ],
    ],
];
