<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   CamagruController.php                              :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:47:02 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:47:41 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

namespace Camagru\Controller;

use Camagru\Utils\Security;

class CamagruController extends AbstractController
{
    function __construct(\PDO $pdo) {
        parent::__construct($pdo);
    }

    public function homeAction()
    {
        $limit = $this->pictureManager::LIMIT;
        $offset = 0;
        $page = 1;

        if (isset($_GET['page']) &&
            ctype_digit($_GET['page']) &&
            $_GET['page'] > 0) {
            $page = $_GET['page'];
            $offset = ($page - 1) * $limit;
        }
        else if (isset($_GET['page']) &&
            !ctype_digit($_GET['page'])){
            $this->notFoundAction();
        }
        $count = $this->pictureManager->count();
        $nb_pages = floor($count / $limit);
        $nb_pages += ($count % $limit) ? 1 : 0;
        $pictures = $this->pictureManager->get($limit, $offset);
        $this->render('home', [
            'pictures' => $pictures,
            'nb_pages' => $nb_pages,
            'page' => $page,
            'i' => 1,
        ]);
    }

    public function showAction()
    {
        $limit = $this->commentManager::LIMIT;
        $page = 1;

        if (!isset($_GET['id']) ||
            !ctype_digit(strval($_GET['id'])) ||
            !$picture = $this->pictureManager->getById($_GET['id'])) {
            $this->notFoundAction();
        }
        if (isset($_GET['page']) &&
            ctype_digit(strval($_GET['page'])) &&
            $_GET['page'] > 0) {
            $page = $_GET['page'];
        }
        $picture = $this->pictureManager->getById($_GET['id']);
        $count = $this->commentManager->count($picture);
        $nb_pages = floor($count / $limit);
        $nb_pages += ($count % $limit) ? 1 : 0;
        $page = $page > $nb_pages ? $nb_pages : $page;
        $offset = $limit * ($page - 1);
        $comments = $this->commentManager->get($picture, $limit, $offset);
        $connected = $this->userManager->isConnected();
        $likes = $picture->getLikes() === null ? 0 : $picture->getLikes();
        if ($connected) {
            $user = $this->userManager->getCurrentUser();
            $hasLiked = $connected ? $this->pictureManager->userHasLiked($user, $picture) : false;
        }
        $this->render('show', [
            'picture' => $picture,
            'likes' => $likes,
            'hasLiked' => $hasLiked,
            'connected' => $connected,
            'comments' => $comments,
            'nb_pages' => $nb_pages,
            'page' => $page,
            'i' => 1,
        ]);
    }

    public function commentAction()
    {
        if (!$this->userManager->isConnected()) {
            $this->redirect('/login');
        }
        if (!isset($_GET['id']) ||
            !ctype_digit(strval($_GET['id'])) ||
            !$picture = $this->pictureManager->getById($_GET['id'])) {
            $this->notFoundAction();
        }
        if (isset($_POST) && isset($_POST['content'])) {
            $user = $this->userManager->getByUsername($_SESSION['login']);
            $comment = $this->commentManager->create($user, $picture, $_POST['content']);
            $this->commentManager->add($comment);
            $pictureUser = $this->userManager->getById($picture->getUserId());
            $this->mailer->newComment($pictureUser, $picture);
        }
        $this->addFlashMessage('success', 'Your comment was correctly posted');
        $this->redirect('/show?id='.$_GET['id']);
    }

    public function likeAction()
    {
        if (!$this->userManager->isConnected()) {
            $this->redirect('/login');
        }
        if (!isset($_GET['id']) ||
            !ctype_digit(strval($_GET['id'])) ||
            !$picture = $this->pictureManager->getById($_GET['id'])) {
            $this->notFoundAction();
        }
        $user = $this->userManager->getCurrentUser();
        $picture = $this->pictureManager->getById($_GET['id']);
        $this->pictureManager->toggleLike($user, $picture);
        $this->addFlashMessage('success', 'Your like has been updated.');
        $this->redirect('/show?id='.$_GET['id']);
    }

    public function picturesAction()
    {
        $limit = $this->pictureManager::LIMIT;
        $offset = 0;

        if (isset($_GET['limit']) &&
            isset($_GET['offset']) &&
            ctype_digit(strval($_GET['limit'])) &&
            ctype_digit(strval($_GET['offset']))) {
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];
        }
        $pictures = $this->pictureManager->get($limit, $offset);
        printf('%s', json_encode($pictures));
    }

    public function accountAction()
    {
        if (!$this->userManager->isConnected()) {
            $this->redirect('/login');
        }
        $limit = $this->pictureManager::LIMIT;
        $offset = 0;
        $page = 1;

        if (isset($_GET['page']) &&
            ctype_digit($_GET['page']) &&
            $_GET['page'] > 0) {
            $page = $_GET['page'];
            $offset = ($page - 1) * $limit;
        }
        $user = $this->userManager->getByUsername($_SESSION['login']);
        $count = $this->pictureManager->count($user);
        $nb_pages = floor($count / $limit);
        $nb_pages += ($count % $limit) ? 1 : 0;
        $pictures = $this->pictureManager->get($limit, $offset, $user);
        $this->render('account', [
            'pictures' => $pictures,
            'nb_pages' => $nb_pages,
            'page' => $page,
            'i' => 1,
        ]);
    }

    public function newPictureAction()
    {
        if (!$this->userManager->isConnected()) {
            $this->redirect('/login');
        }
        if (isset($_POST) && isset($_POST['pic']) && isset($_POST['overlay'])) {
            $user = $this->userManager->getByUsername($_SESSION['login']);
            $pic = $this->pictureManager->create($user, $_POST['pic'], $_POST['overlay']);
            $this->pictureManager->add($pic);
        }
        $this->render('newPicture', []);
    }

    public function deleteAction()
    {
        if (!isset($_GET['id']) ||
            !ctype_digit(strval($_GET['id'])) ||
            !$picture = $this->pictureManager->getById($_GET['id'])) {
            $this->notFoundAction();
        }
        $picture = $this->pictureManager->getById($_GET['id']);
        if (!$this->userManager->isConnected()) {
            $this->redirect('/login');
        }
        $user = $this->userManager->getCurrentUser();
        if ($picture->getUserId() != $user->getId()) {
            $this->forbiddenAction();
        }
        $this->pictureManager->delete($picture);
        $this->redirect('/account');
    }

    public function loginAction()
    {
        if (isset($_POST) && isset($_POST['username']) && isset($_POST['password'])) {
            $user = $this->userManager->getByUsername($_POST['username']);
            $password = hash('sha512', $_POST['password']);
            if ($user && ($password == $user->getPassword())) {
                $_SESSION['login'] = $user->getUsername();
                $this->redirect('/account');
            } else {
                $this->addFlashMessage('error', 'Authentification failed.');
                $this->redirect('/login');
            }
        }
        $this->render('login', []);
    }

    public function signinAction()
    {
        if (isset($_POST) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
            if (!Security::isPasswordSecure($_POST['password'])) {
                $this->addFlashMessage('warning', 'Your password is not strong enough.');
                $this->redirect('/signin');
            }
            try {
                $this->addFlashMessage('success', 'You successfully created your account, check your mail to validate it !');
                $user = $this->userManager->create($_POST['username'], $_POST['email'], $_POST['password']);
                $this->userManager->add($user);
                $this->mailer->register($user);
                $this->redirect('/');
            } catch (\Exception $e) {
                $this->addFlashMessage('warning', 'Username or email already in use');
                $this->redirect('/signin');
            }
        }
        $this->render('signin', []);
    }

    public function activateAction(UserInterface $user = null)
    {
        if (!$user) {
            if (!(isset($_GET) && isset($_GET['key']) &&
                $user = $this->userManager->getByHash($_GET['key']))) {
                $this->addFlashMessage('error', 'Your key is invalid.');
                $this->redirect('/');
            }
            $user->setActive(1);
        }
        try {
            $this->userManager->update($user);
        } catch (\PDOException $e) {
            $this->activateAction($user);
        }
        $this->addFlashMessage('success', 'You successfully activated your account !');
        $_SESSION['login'] = $user->getUsername();
        $this->redirect('/account');
    }

    public function forgotAction()
    {
        if (isset($_POST) && isset($_POST['username'])) {
            if (($user = $this->userManager->getByUsername($_POST['username']))) {
                $this->mailer->reset($user);
            }
            $this->addFlashMessage('warning', 'A link to reset your password was sent to your email.');
            $this->redirect('/');
        }
        $this->render('forgot', []);
    }

    public function resetAction(UserInterface $user = null)
    {
        if (!$user) {
            if (!(isset($_GET) && isset($_GET['key']) &&
                $user = $this->userManager->getByHash($_GET['key']))) {
                $this->addFlashMessage('error', 'Your key is invalid.');
                $this->redirect('/');
            }
        }
        if (isset($_POST) && isset($_POST['password'])) {
            if (!Security::isPasswordSecure($_POST['password'])) {
                $this->addFlashMessage('warning', 'Your password is not strong enough.');
                $this->redirect('/reset?key='.$_GET['key']);
            }
            $user->setPlainPassword($_POST['password']);
            try {
                $this->userManager->update($user);
            } catch (\PDOException $e) {
                $this->resetAction($user);
            }
            $_SESSION['login'] = $user['username'];
            $this->addFlashMessage('success', 'Your password was reset.');
            $this->redirect('/account');
        }
        $this->render('reset', []);
    }

    public function logoutAction()
    {
        if (!$this->userManager->isConnected()) {
            $this->redirect('/login');
        }
        session_unset();
        session_destroy();
        $this->redirect('/');
    }
}
