<?php 
    require_once "vendor/autoload.php";

    use CMS\Models\Post;
    use CMS\Models\User;

    $postModel = new Post();

    if( !isset($_GET['id']) || empty($_GET['id']) || !$postModel->postExists($_GET['id']))
    {
        die("Post doesn't exist.");
    }

    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    $post = $postModel->getPostsById($_GET['id']);
    $userModel = new User();
    $user = $userModel->getUserById($post['UserID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Post details</title>
    <link rel="icon" type="image/x-icon" href="images/file.svg">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="home-body">

  <div class="post-details-wrapper">

    <div class="back-row">
      <a href="/CMS-Project/home.php" class="btn back-btn">⬅ Back to Home</a>
    </div>

    <article class="post post-card">

        <header class="post-top">
            <div style="flex:1; min-width: 240px;">
                <h1 class="post-title"><?= $post['title'] ?></h1>
            </div>

            <div class="post-meta">
                <p class="post-details-author">Author: <?= $user['name'] ?></p>
                <p class="post-date">Published: <?= $post['date'] ?></p>
            </div>
        </header>

        <div class="post-body">
            <?= $post['description'] ?>
            <p>Category: <?= $post['category'] ?></p>
            <p>Tags: <?= $post['tags'] ?></p>
        </div>
        <br>
        <?php if( (isset($_SESSION['userId']) && $_SESSION['userId'] == $user['id'])
        || (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') ): ?>
        <form action="postDetails.php/?postId="<?= $post['id'] ?>></form>
        <a href="#"><button class="btn small">Edit</button></a>
        <?php endif; ?>
        

    </article>

  </div>

</body>
</html>

