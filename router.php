<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   router.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:51:13 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:51:21 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

// Usage exemple:
// php -S 127.0.0.1:8001 router.php

if (php_sapi_name() == 'cli-server') {
    if ('/config/setup.php' === $_SERVER['REQUEST_URI'] &&
        in_array($_SERVER['REMOTE_ADDR'], ['::1', '127.0.0.1'])) {
        return false;
    } elseif (preg_match('#^/(\.|src|config|router.php)#', $_SERVER['REQUEST_URI'])) {
        header('Location: /404');
    } else {
        return false;
    }
}
