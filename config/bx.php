<?php

return [
    'api' => [
        'base_url' => 'https://bx.in.th/api/',
    ],

    'alert' => [
        'line' => [
            'enabled' => env('BX_ALERT_LINE', false),
            'channel_access_token' => env('LINE_CHANNEL_ACCESS_TOKEN', ''),
            'channel_secret' => env('LINE_CHANNEL_SECRET', ''),
            'user_ids' => explode(',', env('LINE_USER_IDS', ''))
        ],
    ],
];