<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Security.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:54:54 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:55:00 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Utils;

class Security
{
    public static function isPasswordSecure($password)
    {
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/", $password)) {
            return true;
        } else {
            return false;
        }
    }
}
