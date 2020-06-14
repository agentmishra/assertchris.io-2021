<?php

use App\Models\WinkPostProxy;

return [
    'feeds' => [
        'main' => [
            'items' => WinkPostProxy::class . '@getFeedItems',
            'url' => '/feed',
            'title' => 'assertchris.io feed',
            'description' => 'Posts, slides, and videos by Christopher Pitt',
            'language' => 'en-US',
            'view' => 'feed::atom',
            'type' => 'application/atom+xml',
        ],
    ],
];
