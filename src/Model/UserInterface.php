<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   UserInterface.php                                  :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:54:28 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:54:38 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Model;

interface UserInterface
{
    public function getId();

    public function getUsername();

    public function getEmail();

    public function getPassword();

    public function getHash();

    public function getActive();

    public function setUsername($username);

    public function setEmail($email);

    public function setPassword($password);

    public function setHash($hash);

    public function setActive($active);
}
