<?php

use CMS\Controlers\PostController;
use CMS\Controlers\UserController;
    require_once "vendor/autoload.php";

    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if( isset($_POST['login']) )
    {
        $userController = new UserController();
        $userController->login($_POST);
    }
    
    if( isset($_POST['register']) )
    {
        $userController = new UserController();
        $userController->register($_POST);
    }

    if( isset($_POST['post']) )
    {
        $postController = new PostController();
        $postController->upload($_POST);
    }

    if( isset($_POST['edit']) )
    {
        $postController = new PostController();
        $postController->edit($_POST);
    }