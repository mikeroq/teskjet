<?php

return [
    'App\Models\Customer' => [
        'name' => 'Customer',
        'route' => 'customers.show',
        'parent' => true
    ],
    'App\Models\CustomerLocation' => [
        'name' => 'Customer Location',
        'route' => 'customers.show',
        'parent' => false
    ],
];
