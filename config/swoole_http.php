<?php
return [
    'host' => env('SWOOLE_HTTP_HOST', '127.0.0.1'),
    'port' => env('SWOOLE_HTTP_PORT', '9501'),
    'options' => [
        'worker_num' => 4,
        'pid_file' => storage_path('logs/swoole_http.pid'),
    ],
];
