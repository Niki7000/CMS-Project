<?php
    require_once "vendor/autoload.php";
    use CMS\Controlers\UserController;
    $userController = new UserController();
    $userController->logout();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="images/file.svg">
        <title>Log out</title>
    </head>

    <body>
        <h2>Logged out successfully.</h4>
        <h3>Go back to <a href="index.php">welcome page</a></h5>
    </body>

</html>

