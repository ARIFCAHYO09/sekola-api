<?php

return [
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            // Add bugsnag to the stack:
            'channels' => ['single', 'bugsnag'],
        ],
        'bugsnag' => [
            'driver' => 'bugsnag',
        ],
    ]
];
