<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   index.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:51:26 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:51:35 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

session_start();

define('ROOT', __DIR__.DIRECTORY_SEPARATOR);
define('CONFIG', ROOT.'config'.DIRECTORY_SEPARATOR);
define('SRC', ROOT.'src'.DIRECTORY_SEPARATOR);
define('VIEWS', SRC.'views'.DIRECTORY_SEPARATOR);
define('UPLOADS', ROOT.'uploads'.DIRECTORY_SEPARATOR);

require CONFIG.'kernel.php';
