<?php

namespace Camagru\Entity;

use Camagru\Model\CommentInterface;

class Comment extends User implements CommentInterface
{
    protected $id;

    protected $userId;

    protected $pictureId;

    protected $content;

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPictureId()
    {
        return $this->pictureId;
    }

    public function getContent()
    {
        return $this->content;
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

    public function setPictureId($pictureId)
    {
        $this->pictureId = $pictureId;

        return $this;
    }

    public function setContent($content)
    {
        $this->content = strip_tags($content);

        return $this;
    }
}
