<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   setup.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:55:49 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:55:56 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require_once 'autoload.php';
require_once 'pdo.php';

use Camagru\Entity\User;
use Camagru\Factory\UserManager;

if (php_sapi_name() !== 'cli') {
    echo '<html><body><pre>';
}
echo "############################\n";
echo "#                          #\n";
echo "#        S E T U P         #\n";
echo "#                          #\n";
echo "############################\n\n";

echo 'Install schemas ........';
/*
 * Get schema
 */
$schema = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'schema.sql');
$pdo->exec($schema);

echo "[OK]\n";

/*
 * Get fixtures
 */

echo 'Install fixtures .......';

// test user
$userManager = new UserManager($pdo);
$user = $userManager->create('test', 'jlagneau@student.42.fr', 'test');

$user->setActive(1);

$userManager->add($user);

echo "[OK]\n";

// test pictures
