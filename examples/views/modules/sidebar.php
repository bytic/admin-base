<?php

declare(strict_types=1);


$menu = [];

$menu[] = [
    'name' => 'Home',
    'href' => 'admin',
    'icon' => 'fa-home',
    'enabled' => true,
    'submenus' => [
    ]
];

$menu['pages'] = [
    'name' => 'Pages',
    'href' => '#',
    'icon' => 'fa-file',
    'enabled' => true,
    'submenus' => [
        "tos" => [
            'name' => 'Terms of Service',
            'href' => 'tos',
//            'icon' => 'fa-file',
        ],
        "privacy" => [
            'name' => "privacy",
            'href' => 'privacy',
//            'icon' => 'fa-file',
        ],
    ]
];

$menu['settings'] = [
    'name' => 'settings',
    'href' => '',
    'icon' => 'fa-cog',
    'enabled' => true,
    'submenus' => []
];

echo $this->load(
    '/modules/sidebar/layout',
    ['menu' => $menu]
);