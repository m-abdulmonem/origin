<?php


return [
    [
        'url' => 'dashboard',
        'title' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => ''
    ],
    [
        'url' => 'orders',
        'title' => 'Orders',
        'route' => 'orders',
        'icon' => '',
        'badge' => ''
    ],
    [
        'title' => 'products',
        'icon' => "fab fa-brands fa-buffer",
        'permission' => '',
        'sub_menu' => [
            [
                'url' => 'products',
                'title' => 'Products',
                'route' => 'products.index',
                'permission' => ''
            ]
        ]
    ],
    [
        'title' => 'services',
        'icon' => "fab fa-brands fa-buffer",
        'permission' => '',
        'sub_menu' => [
            [
                'url' => 'services',
                'title' => 'Services',
                'route' => 'services.index',
                'permission' => ''
            ]
        ],
    ],
    [
        'title' => 'pages',
        'icon' => "fab fa-brands fa-buffer",
        'permission' => '',
        'sub_menu' => [
            [
                'url' => 'appearance/pages',
                'title' => 'Pages',
                'route' => 'pages.index',
                'permission' => ''
            ]
        ],
    ],

];
