<?php

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