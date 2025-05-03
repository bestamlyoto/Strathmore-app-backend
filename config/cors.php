<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'register'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Change in production!
    'allowed_headers' => ['*'],
    'max_age' => 0,
    'supports_credentials' => true,
];