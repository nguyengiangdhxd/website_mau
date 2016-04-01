<?php
$r = array(
    '__urlSuffix__' => '.html',
    '__remap__' => array(
        'route' => 'frontend/default'
    ),
    '/' => array(
        'route' => 'frontend/default'
    ),
    '{controller}' => array(
        'route' => '{controller}/default'
    ),
    '{controller}/{action}' => array(
        'route' => '{controller}/{action}'
    ),
    '{controller}/{action}/{id:\d+}' => array(
        'route' => '{controller}/{action}'
    ),

    'gio-hang' => [
        'route' => 'products/cart'
    ],

    'nhom-san-pham/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => array(
        'route' => 'products/category'
    ),

    'san-pham/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => [
        'route' => 'products/detail'
    ],

    'danh-muc/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => array(
        'route' => 'category/default'
    ),

    'bai-viet/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => array(
        'route' => 'post/detail'
    ),

    'lien-he' => array(
        'route' => 'contact/default'
    )
);
$r = \Toxotes\Cms::route($r);
return $r;