<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   pdo.php                                            :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:56:25 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:56:33 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

require 'database.php';

try {
    $pdo = new PDO($DB_DSN);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}
