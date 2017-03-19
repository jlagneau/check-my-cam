<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   AbstractController.php                             :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:47:55 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:48:10 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Controller;

use Camagru\Factory\CommentManager;
use Camagru\Factory\PictureManager;
use Camagru\Factory\UserManager;
use Camagru\Utils\Mailer;

abstract class AbstractController
{
    protected $mailer;

    protected $commentManager;

    protected $pictureManager;

    protected $userManager;

    protected function __construct(\PDO $pdo)
    {
        $this->mailer = new Mailer();
        $this->userManager = new UserManager($pdo);
        $this->commentManager = new CommentManager($pdo);
        $this->pictureManager = new PictureManager($pdo, $this->commentManager);
    }

    public function notFoundAction()
    {
        header('HTTP/1.0 404 Not found');
        $this->render('404', []);
    }

    public function forbiddenAction()
    {
        header('HTTP/1.0 403 Forbidden');
        $this->render('403', []);
    }

    protected function addFlashMessage($type, $message)
    {
        $_SESSION['flash'] = [];
        $_SESSION['flash']['type'] = $type;
        $_SESSION['flash']['message'] = $message;
    }

    protected function render($action, array $args)
    {
        extract($args);
        ob_start();
        require VIEWS.$action.'.php';
        $content = ob_get_clean();
        require VIEWS.'layout.php';
        $_SESSION['flash'] = null;
        exit();
    }

    protected function redirect($uri)
    {
        header('Location: '.$uri);
        exit();
    }
}
