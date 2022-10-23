<?php


return [
    [
        'url' => 'index',
        'title' => 'Dashboard',
        'route' => 'dashboard.index',
        'icon' => "fas fa-tachometer-alt",
    ],
    [
        'url' => 'orders',
        'title' => 'Orders',
        'route' => 'dashboard.orders.index',
        'permission' => 'read-orders',
        'icon' => "fas fa-shopping-cart",
        'badge' => true
    ],
    [
        'url' => 'subscriptions',
        'title' => 'Subscriptions',
        'route' => 'dashboard.subscriptions.index',
        'permission' => 'read-subscriptions',
        'icon' => "fas fa-file-invoice-dollar",
    ],

    [
        'title' => 'services',
        'icon' => "fas fa-hand-holding-medical",
        'permission' => ['read-services','read-offers'],
        'sub_menu' => [
            [
                'url' => 'services',
                'title' => 'Services',
                'route' => 'dashboard.services.index',
                'permission' => 'read-services'
            ],
            [
                'url' => 'offers',
                'title' => 'Offers',
                'route' => 'dashboard.offers.index',
                'permission' => 'read-offers'
            ],
        ],
    ],
    [
        'title' => 'Appearance',
        'icon' => "fas fa-palette",
        'permission' => ['read-pages','read-editor','read-widgets','read-menus','read-sliders'],
        'sub_menu' => [
            [

                'url' => 'appearance/pages',
                'title' => 'Pages',
                'route' => 'dashboard.appearance.pages.index',
                'permission' => 'read-pages'
            ],

            [
                'url' => 'appearance/editor',
                'title' => 'Editor',
                'route' => 'dashboard.appearance.editor.index',
                'permission' => 'read-editor'
            ],

            [
                'url' => 'appearance/widgets',
                'title' => 'Widgets',
                'route' => 'dashboard.appearance.widgets.index',
                'permission' => 'read-widgets'
            ],

            [
                'url' => 'appearance/menus',
                'title' => 'Menus',
                'route' => 'dashboard.appearance.menus.index',
                'permission' => 'read-menus'
            ],

            [
                'url' => 'appearance/sliders',
                'title' => 'Sliders',
                'route' => 'dashboard.appearance.sliders.index',
                'permission' => 'read-sliders'
            ],

        ],
    ],

    [
        'title' => 'users',
        'icon' => "fas fa-users",
        'permission' => ['read-users','read-nurses','read-clients'],
        'sub_menu' => [
            [
                'url' => 'users',
                'title' => 'Users',
                'route' => 'dashboard.users.index',
                'permission' => 'read-users'
            ],
            [
                'url' => 'nurses',
                'title' => 'Nurses',
                'route' => 'dashboard.nurses.index',
                'permission' => 'read-nurses'
            ],
            [
                'url' => 'clients',
                'title' => 'Clients',
                'route' => 'dashboard.clients.index',
                'permission' => 'read-users'
            ],
        ],
    ],

    [
        'url' => 'faq',
        'title' => 'FAQ',
        'route' => 'dashboard.faq.index',
        'permission' => 'read-faq',
        'icon' => 'fas fa-question-circle',
    ],
    [
        'title' => 'messages&reports',
        'icon' => "fas fa-mail-bulk",
        'permission' => ['read-messages','read-reports'],
        'sub_menu' => [
            [
                'url' => 'messages',
                'title' => 'Messages',
                'route' => 'dashboard.messages.index',
                'permission' => 'read-messages'
            ],
            [
                'url' => 'reports',
                'title' => 'Reports',
                'route' => 'dashboard.reports.index',
                'permission' => 'read-reports'
            ],
        ],
    ],

    [
        'url' => 'settings',
        'title' => 'Settings',
        'route' => 'dashboard.settings.index',
        'permission' => 'read-settings',
        'icon' => 'fas fa-cogs',
    ],

];
