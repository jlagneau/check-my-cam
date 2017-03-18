<?php

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
