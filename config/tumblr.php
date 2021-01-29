<?php

return [
    'CONSUMER_KEY' => function_exists('env') ? env('TUMBLR_CONSUMER_KEY', '') : '',
    'CONSUMER_SECRET' => function_exists('env') ? env('TUMBLR_CONSUMER_SECRET', '') : '',
    'ACCESS_TOKEN' => function_exists('env') ? env('TUMBLR_TOKEN', '') : '',
    'ACCESS_TOKEN_SECRET' => function_exists('env') ? env('TUMBLR_TOKEN_SECRET', '') : '',
];
