<?php 
    require_once "vendor/autoload.php"; 
    use CMS\Models\Post;
    use CMS\Models\User;

    $postModel = new Post();
    $allPosts = $postModel->getAllPosts();
    $userModel = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="images/file.svg">
    <link rel="stylesheet" href="style.css">
</head>
<body class="home-body">

    <nav class="navbar">
        <div class="nav-left">
            <form action="home.php" method="GET" class="filter-form">
                <select name="category" class="form-input small">
                    <option value="">All Categories</option>
                    <option value="news">News</option>
                    <option value="tech">Tech</option>
                    <option value="lifestyle">Lifestyle</option>
                </select>
                <input type="text" name="tag" class="form-input small" placeholder="Filter by tag">
                <button type="submit" class="btn small">Filter</button>
            </form>
        </div>
        <div class="nav-right">
            <a href="logout.php" class="btn logout">Log out</a>
        </div>
    </nav>

    <main class="main-content">
        <?php foreach($allPosts as $post): ?>
        <div class="post">
            <div class="post-header">
            <h2 class="post-title"><?= $post['title'] ?></h2>
            <h3 class="post-author">Author: <?= ($userModel->getUserById($post['UserID']))['name'] ?></h3>
            </div>
            <p class="post-content">
            <?= $post['description'] ?>
            </p>
        </div>
        <?php endforeach; ?>

    </main>

</body>
</html>