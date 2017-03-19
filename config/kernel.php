<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   kernel.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:56:37 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:56:43 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

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
