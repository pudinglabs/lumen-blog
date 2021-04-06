<?php

    return [
        'default' => 'mongodb',
        'connections' => [
            'mongodb' => [
                'driver' => 'mongodb',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', 27017),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'options' => [
                    'ssl' => 'true',
                    'replicaSet' => 'atlas-ultioq-shard-0',
                    'authSource' => 'admin',
                    'retryWrites' => 'true',
                    'w' => 'majority',
                ],
            ],
        ],
        'migrations' => 'migrations',
    ];
