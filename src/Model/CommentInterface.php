<?php

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
