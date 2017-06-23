<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |

     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type, Authorization'],
    'allowedMethods' => ['GET, POST, PUT, PATCH, DELETE, OPTIONS'],
    'exposedHeaders' => [],
    'maxAge' => 0,
    'hosts' => [],
];