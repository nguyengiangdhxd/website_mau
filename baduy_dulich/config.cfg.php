<?php
return [
    'i18n' => [
        'enable' => true,
        'default_fallback' => ['vi'],
        'default_locale' => 'vi-VN',
        'resource' => [
            'vi-VN' => []
        ]
    ],

    /****** MEDIA ******/
    'media' => [
        'sfs_enable' => true,
        'sfs_path' => '/thumbs/'
    ],

    /****** Session ******/
    'session' => array(
        'storage' => '', // \Flywheel\Session\Storage\File
        'name'  => '@LiT4cK@)!%',
        'lifetime' => 86400,
        //'cookie_domain' => '',
        'cookie_exception' => true,
        'cookie_basename' => '@LiT4cK',
        'cookie_secret' => 'mZu&4#N_=*Xt7qnGP7Taw^!+',
    ),

    /**** LOGGER ****/
    'logger'=>array(
        'debug'=>100,
        'path' => ROOT_PATH.'/runtime/log/',
    ),

    /***** DATABASE *****/
    'database' => array(
        'default' => array(
            'adapter' => 'mysqli', //sqlite, mysql, mssql, oracle or pgsql
            'dsn' => 'mysql:host=localhost;dbname=baduy_dulich',
            'db_user' => 'root',
            'db_pass' => '',
            'cache_prepare' => true,
            'slaves' => array(
            ),
        ),

        '__default__' => 'default'
    ),

    'site_setting' => [
        'footer' => [
            'label' => t('Nội dung chân trang'),
            'control' => 'textarea',
            'type' => 'text'
        ],

        'info_contact_form' => [
            'label' => t('Nội dung mô tả trên form thông tin liên hệ'),
            'control' => 'textarea',
            'type' => 'text'
        ],

        'facebook_page' => [
            'label' => t('Facebook'),
            'control' => 'input',
            'type' => 'text'
        ],

//        'hotline_category_id' => [
//            'label' => t('ID thư mục HOTLINE'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'yahoo_category_id' => [
//            'label' => t('ID thư mục YAHOO'),
//            'control' => 'input',
//            'type' => 'text'
//        ],


//        'post_intro_id' => [
//            'label' => t('ID bài viết giới thiệu trên trang chủ'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'number_product_perpage' => [
//            'label' => t('Số sản phẩm hiển thị trên một trang (Nếu không điền thì lấy mặc định là 20)'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

        'banner_url' => [
            'label' => t('Đường dẫn ảnh banner trên trang'),
            'control' => 'input',
            'type' => 'text'
        ],

        'logo_url' => [
            'label' => t('Đường dẫn ảnh logo trên trang'),
            'control' => 'input',
            'type' => 'text'
        ],

//        'product_cat_ids' => [
//            'label' => t('Cấu hình hiển thị nhóm sản phẩm trên trang chủ (VD: 40,41). P/s: Nếu để trống thì hiển thị tất'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'product_cat_limit' => [
//            'label' => t('Cấu hình số sản phẩm hiển thị trên nhóm ngoài trang chủ. Mặc định hiển thị 4 sản phẩm.'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'product_cat_other_limit' => [
//            'label' => t('Cấu hình số sản phẩm cùng loại hiển thị trong trang chi tiết sản phẩm. Mặc định hiển thị 4 sản phẩm.'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'news_cat_ids' => [
//            'label' => t('Cấu hình hiển thị nhóm tin tức trên trang chủ (VD: 40,41). P/s: Nếu để trống thì hiển thị tất'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'news_cat_limit' => [
//            'label' => t('Cấu hình số tin tức hiển thị trên nhóm ngoài trang chủ. Mặc định hiển thị 4 tin tức.'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'short_cut' => [
//            'label' => t('Shortcut chân trang (nhập ID danh mục ngăn cách với nhau bằng dấu phẩy VD: 25, 26)'),
//            'control' => 'input',
//            'type' => 'text'
//        ],

//        'recruitment_phone' => [
//            'label' => t('Số điện thoại tuyển dụng'),
//            'control' => 'input',
//            'type' => 'text'
//        ],
//
//        'recruitment_email' => [
//            'label' => t('Email tuyển dụng'),
//            'control' => 'input',
//            'type' => 'text'
//        ]
    ]
];