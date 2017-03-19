<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   AbstractEntity.php                                 :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:53:54 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:54:01 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Model;

abstract class AbstractEntity implements \JsonSerializable
{
    public function JsonSerialize()
    {
        $array = get_object_vars($this);

        return $array;
    }
}
