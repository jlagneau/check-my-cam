<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   Mailer.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:54:43 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:54:49 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Utils;

use Camagru\Model\UserInterface;
use Camagru\Model\PictureInterface;

class Mailer
{
    public function register(UserInterface $user)
    {
        $scheme = $this->isHTTPS() ? 'https' : 'http';
        $message = '
        <html>
            <head>
               <title>Camagru register</title>
            </head>
            <body>
                <p>
                    Welcome '.$user->getUsername().' !<br /><br />

                    To activate your account you must click on this link:<br />
                    <a href="'.$scheme.'://'.$_SERVER['HTTP_HOST'].'/activate?key='.$user->getHash().'">
                        '.$scheme.'://'.$_SERVER['HTTP_HOST'].'/activate?key='.$user->getHash().'</a>
                    <br /><br />

                    If you did not register to Camagru, ignore this email.<br /><br />

                    Camagru webmaster.
                </p>
            </body>
        </html>
        ';
        $this->send($message, 'register', $user);
    }

    public function reset(UserInterface $user)
    {
        $scheme = $this->isHTTPS() ? 'https' : 'http';
        $message = '
        <html>
            <head>
               <title>Camagru reset request</title>
            </head>
            <body>
                <p>
                    Hello '.$user->getUsername().' !<br /><br />

                    Your requested to change your password, to proceed, click on the following link:<br />
                    <a href="'.$scheme.'://'.$_SERVER['HTTP_HOST'].'/reset?key='.$user->getHash().'">
                        '.$scheme.'://'.$_SERVER['HTTP_HOST'].'/reset?key='.$user->getHash().'</a>
                    <br /><br />

                    If you did not request to change your password on Camagru, ignore this email.<br /><br />

                    Camagru webmaster.
                </p>
            </body>
        </html>
        ';
        $this->send($message, 'reset password', $user);
    }

    public function newComment(UserInterface $user, PictureInterface $picture)
    {
        $scheme = $this->isHTTPS() ? 'https' : 'http';
        $message = '
        <html>
            <head>
               <title>Camagru new comment</title>
            </head>
            <body>
                <p>
                    Hello '.$user->getUsername().' !<br /><br />

                    Someone posted a comment on one of your picture, to view it, click on the following link:<br />
                    <a href="'.$scheme.'://'.$_SERVER['HTTP_HOST'].'/show?id='.$picture->getId().'">
                        '.$scheme.'://'.$_SERVER['HTTP_HOST'].'/show?id='.$picture->getId().'</a>
                    <br /><br />

                    If you did not post a picture on Camagru, ignore this email.<br /><br />

                    Camagru webmaster.
                </p>
            </body>
        </html>
        ';
        $this->send($message, 'new comment', $user);
    }

    private function isHTTPS()
    {
        if (isset($_SERVER['HTTPS'])) {
            return true;
        }

        return false;
    }

    private function send($message, $title, UserInterface $user)
    {
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=utf8'."\r\n";

        $headers .= 'To: '.$user->getUsername().' <'.$user->getEmail().'>'."\r\n";
        $headers .= 'From: Camagru <noreply@camagru.com>'."\r\n";

        mail($user->getEmail(), '[Camagru] '.$title, $message, $headers);
    }
}
