<?php 
    require_once "vendor/autoload.php"; 
    use CMS\Models\Post;
    use CMS\Models\User;

    $postModel = new Post();
    $categories = $postModel->getAllCategoires();
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
                    <?php foreach($categories as $category): ?>
                    <option value="<?= $category[0] ?>"><?= $category[0] ?></option>
                    <?php endforeach; ?>
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
        <?php 
            if((!isset($_GET['category']) || empty($_GET['category'])) && (!isset($_GET['tag']) || empty($_GET['tag']))){
                $finalPosts = $postModel->getAllPosts();
            }
            else{
                $finalPosts = $postModel->getAllFilteredPosts($_GET);
            } 
        ?>

        <?php foreach($finalPosts as $post): ?>
        <div class="post">
            <div class="post-header">
            <h2 class="post-title"><?= $post['title'] ?></h2>
            <h3 class="post-author">Author: <?= ($userModel->getUserById($post['UserID']))['name'] ?></h3>
            </div>
            <h4 class="post-content">
            <?= $post['description'] ?>
            </h4>
            <p class="post-content">
            Category: <?= $post['category'] ?>
            </p>
            <p class="post-content">
            Tags: <?= $post['tags'] ?>
            </p>
            <p class="post-content">
            Date uploaded: <?= $post['date'] ?>
            </p>
        </div>
        <?php endforeach; ?>
        
    </main>

</body>
</html>