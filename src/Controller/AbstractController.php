<?php

namespace Camagru\Controller;

abstract class AbstractController
{
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
    }

    protected function redirect($uri)
    {
        header('Location: '.$uri);
        exit();
    }
}
