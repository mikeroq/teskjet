<?php

return [
    App\Models\Customer::class => [
        'name' => 'Customer',
        'route' => 'customers.show'
    ],
    App\Models\CustomerLocation::class => [
        'name' => 'Customer Location',
        'route' => 'customers.location'
    ],
];
