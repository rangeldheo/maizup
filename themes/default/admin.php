<?php

$adminPages = [
    'index', 'banners', 'chat', 'chat.relatorio', 'challenges', 'user-edit', 'balance'
];

if (!empty($URL[1]) && in_array($URL[1], $adminPages)):
    $arquivo = $URL[1];
else:
    $arquivo = 'index';
endif;

if (file_exists('themes/' . THEME . "/admin/{$arquivo}.php")):
    require REQUIRE_PATH . "/admin/{$arquivo}.php";
else:
    require REQUIRE_PATH . '/404.php';
endif;


