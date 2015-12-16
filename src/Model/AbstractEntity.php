<?php

namespace Camagru\Model;

abstract class AbstractEntity implements \JsonSerializable
{
    public function JsonSerialize()
    {
        $array = get_object_vars($this);

        return $array;
    }
}
