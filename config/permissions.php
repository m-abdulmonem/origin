<?php


//c => create
//r => read all
//u => update,
//d => delete
//v => view single item

$perArr =  ['c','r','u','d','v'];

return [
    'superAdmin' => [
        'clients' => ['d','r','v'],
        'pages' => $perArr,
        'services' => $perArr,
        'orders' => $perArr,
        'subscriptions' => $perArr,
        'settings' => ['r','u'],
        'offers' => $perArr,
        'editor' =>  $perArr,
        'widgets' =>  $perArr,
        'menus' =>  $perArr,
        'sliders' =>  $perArr,
        'users' =>  $perArr,
        'nurses' =>  $perArr,
        'faq' =>  $perArr,
        'read-messages' => ['r','v','d'],
        'read-reports' => ['r','v','d']
    ]
];
