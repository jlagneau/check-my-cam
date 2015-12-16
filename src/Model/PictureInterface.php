<?php

namespace Camagru\Model;

interface PictureInterface
{
    public function getId();

    public function getUserId();

    public function getPath();

    public function getRealPath();

    public function setUserId($user_id);

    public function setPath($filename);

    public function setRealPath($filename);
}
