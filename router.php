<?php

if (php_sapi_name() == 'cli-server') {
    if ('/config/setup.php' === $_SERVER['REQUEST_URI'] &&
        in_array($_SERVER['REMOTE_ADDR'], ['::1', '127.0.0.1'])) {
        return false;
    } elseif (preg_match('#^/(\.|src|config|router.php)#', $_SERVER['REQUEST_URI'])) {
        header('Location: /403');
    } else {
        return false;
    }
}
