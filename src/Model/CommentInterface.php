<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   CommentInterface.php                               :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:54:07 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:54:13 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Model;

interface CommentInterface
{
    public function getId();

    public function getUserId();

    public function getPictureId();

    public function getContent();

    public function setId($id);

    public function setUserId($userId);

    public function setPictureId($pictureId);

    public function setContent($content);
}
