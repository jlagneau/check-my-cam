<?php

namespace Camagru\Entity;

use Camagru\Model\AbstractEntity;
use Camagru\Model\PictureInterface;

class Picture extends AbstractEntity implements PictureInterface
{
    protected $id;

    protected $userId;

    protected $path;

    protected $realPath;

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getRealPath()
    {
        return $this->realPath;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function setRealPath($realPath)
    {
        $this->realPath = $realPath;

        return $this;
    }
}
