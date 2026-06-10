<?php

return [
    'name'            => env('APP_NAME', 'Eduarda Cardoso Estética'),
    'env'             => env('APP_ENV', 'production'),
    'debug'           => (bool) env('APP_DEBUG', false),
    'url'             => env('APP_URL', 'http://localhost'),
    'asset_url'       => env('ASSET_URL', null),
    'timezone'        => 'America/Sao_Paulo',
    'locale'          => 'pt_BR',
    'fallback_locale' => 'en',
    'faker_locale'    => 'pt_BR',
    'key'             => env('APP_KEY'),
    'cipher'          => 'AES-256-CBC',
    'maintenance'     => ['driver' => 'file'],
];
