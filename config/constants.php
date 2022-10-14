<?php 
    if (!defined('PROTOCOL'))
        define('PROTOCOL', strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https://':'http://');
    if (!defined('SERVER_NAME'))
        define('SERVER_NAME', $_SERVER['SERVER_NAME']);
    if (!defined('DOMAIN'))
        define('DOMAIN', PROTOCOL.SERVER_NAME);
    return [
        'domain' => DOMAIN,
        'url_page' => [
            'login' => DOMAIN."/login.html",
        ],
        'status' => [
            'ok' => 200,
            'fail' => 201,
            'not_login' => 1001,
        ],
        'post' => [
            'features' => 1 // Sản phẩm nội bật
        ],
        'del_flg' => [
            'on'  => 0,
            'off' => 1
        ],
        'limit_product_features' => 6  //Giới hạn hiển thị sản phẩm nổi bật

    ];
?>