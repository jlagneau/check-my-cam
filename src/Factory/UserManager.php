<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   UserManager.php                                    :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:53:38 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:53:46 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Factory;

use Camagru\Entity\User;
use Camagru\Model\UserInterface;

class UserManager
{
    protected $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function create($username, $email, $plainPassword)
    {
        $user = new User();
        $user->setUsername($username)
             ->setEmail($email)
             ->setPlainPassword($plainPassword)
             ->setPlainHash($username.$email.$plainPassword)
             ->setActive(0);

        return $user;
    }

    public function add(UserInterface $user)
    {
        $req = $this->db->prepare('
            INSERT INTO `camagru_user`
                (username, email, password, hash, active)
            VALUES
                (:username, :email, :password, :hash, :active)
        ');
        $req->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'hash' => $user->getHash(),
            'active' => $user->getActive(),
        ]);
    }

    public function getById($id)
    {
        $req = $this->db->prepare('
            SELECT * FROM `camagru_user` WHERE id = ?
        ');
        $req->execute([$id]);
        $resp = $req->fetch();
        if ($resp) {
            return $this->fromColumn($resp);
        }

        return false;
    }

    public function getByUsername($username)
    {
        $req = $this->db->prepare('
            SELECT * FROM `camagru_user` WHERE username = ?
        ');
        $req->execute([strip_tags($username)]);
        $resp = $req->fetch();
        if ($resp) {
            return $this->fromColumn($resp);
        }

        return false;
    }

    public function getByHash($hash)
    {
        $req = $this->db->prepare('
            SELECT * FROM `camagru_user` WHERE hash = ?
        ');
        $req->execute([$hash]);
        $resp = $req->fetch();
        if ($resp) {
            return $this->fromColumn($resp);
        }

        return false;
    }

    public function update(UserInterface $user)
    {
        $req = $this->db->prepare('
            UPDATE `camagru_user` SET
                username = :username,
                email = :email,
                password = :password,
                hash = :hash,
                active = :active
            WHERE id = :id
        ');
        $req->execute([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'hash' => $user->getHash(),
            'active' => $user->getActive(),
        ]);
    }

    public function isConnected()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
            $user = $this->getByUsername($_SESSION['login']);

            return (isset($user)) ? true : false;
        }

        return false;
    }

    public function getCurrentUser()
    {
        return $this->getByUsername($_SESSION['login']);
    }

    private function fromColumn(array $array)
    {
        $array = array_filter($array);
        if (empty($array)) {
            return;
        }
        $user = new User();
        foreach ($array as $key => $value) {
            if (ctype_digit(strval($key))) {
                continue;
            }
            $user->{'set'.ucfirst($key)}($value);
        }

        return $user;
    }
}
