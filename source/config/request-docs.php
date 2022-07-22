<?php

return [
    'debug'         => false,
    'document_name' => 'API Docs',
    'url'           => 'api-docs',
    'middlewares'   => [
    ],
    'docs_path' => base_path('storage/api-docs/'),
    'sort_by'   => 'route_names',

    'only_route_uri_start_with' => 'api',

    'hide_matching' => [
        '#^telescope#',
        '#^docs#',
        '#^api-docs#',
    ],
];
