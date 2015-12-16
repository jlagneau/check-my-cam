<?php

require_once 'autoload.php';
require_once 'pdo.php';

use Camagru\Controller\CamagruController;

$c = new CamagruController($pdo);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$routes = parse_ini_file(CONFIG.'routes.ini');
if ($key = array_search($uri, $routes)) {
    $c->{$key.'Action'}();
} else {
    $c->notFoundAction();
}
