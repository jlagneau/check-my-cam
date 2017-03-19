<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   PictureInterface.php                               :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:54:17 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:54:23 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Model;

use Camagru\Model\CommentInterface;

interface PictureInterface
{
    public function getId();

    public function getUserId();

    public function getPath();

    public function getRealPath();

    public function getLikes();

    public function setUserId($user_id);

    public function setPath($filename);

    public function setRealPath($filename);

    public function setLikes($likes);
}
