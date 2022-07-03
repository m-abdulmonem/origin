<?php


return [
    [
        'url' => 'dashboard',
        'title' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => '',
    ],
    [
        'url' => 'orders',
        'title' => 'Orders',
        'route' => 'orders',
        'permission' => 'read-orders',
        'icon' => '',
        'badge' => true
    ],
    [
        'title' => 'products',
        'icon' => "fab fa-brands fa-buffer",
        'permission' => 'read-product',
        'sub_menu' => [
            [
                'url' => 'products',
                'title' => 'Products',
                'route' => 'products.index',
                'permission' => 'read-product'
            ]
        ]
    ],
    [
        'title' => 'services',
        'icon' => "fab fa-brands fa-buffer",
        'permission' => 'read-services',
        'sub_menu' => [
            [
                'url' => 'services',
                'title' => 'Services',
                'route' => 'services.index',
                'permission' => 'read-services'
            ]
        ],
    ],
    [
        'title' => 'pages',
        'icon' => "fab fa-brands fa-buffer",
        'permission' => 'read-pages',
        'sub_menu' => [
            [
                'url' => 'appearance/pages',
                'title' => 'Pages',
                'route' => 'pages.index',
                'permission' => 'read-pages'
            ]
        ],
    ],

];
