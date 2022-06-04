<?php

return [
    'feed_link' => 'https://sq1-api-test.herokuapp.com/posts',
    'admin'     => [
        'name'     => env('APP_ADMIN_NAME', 'admin'),
        'email'    => env('APP_ADMIN_EMAIL', 'admin@email.com'),
        'password' => env('APP_ADMIN_PASSWORD', 'password'),
    ],
];