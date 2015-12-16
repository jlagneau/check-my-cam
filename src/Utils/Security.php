<?php

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
