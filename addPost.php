<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-centered">

    <div class="card form-container">
        <div class="form-header">
            <h1>Create New Post</h1>
            <p class="form-subtitle">Fill in the fields to publish a new post.</p>
        </div>

        <form action="addPost.php" method="POST" enctype="multipart/form-data" class="post-form">

            <div class="form-top">

                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-input" placeholder="Post title">

                <label class="form-label">Description</label>
                <textarea name="description" class="form-input textarea" placeholder="Write the post description..."></textarea>

                <div class="category-tag-wrapper">
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-input">
                            <option value="">Select category</option>
                            <option value="news">News</option>
                            <option value="tech">Tech</option>
                            <option value="lifestyle">Lifestyle</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tag</label>
                        <input type="text" name="tag" class="form-input" placeholder="e.g. PHP">
                    </div>
                </div>
            </div>

            <div class="image-section">
                <label class="form-label">Featured Image</label>

                <div class="image-preview">
                    <img id="preview" src="" alt="Uploaded image will be displed here.">
                </div>

                <input type="file" name="image" id="image" class="form-input file-input" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn small">Publish</button>
                <a href="home.php"><button class=" btn cancel">Cancel</button></a>
            </div>

        </form>
    </div>

    <script>
        function previewImage(event) {
            const img = document.getElementById("preview");
            img.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

</body>
</html>
