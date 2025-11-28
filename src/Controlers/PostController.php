<?php

    namespace CMS\Controlers;

    use CMS\Models\Post;
    use CMS\Services\SessionService;

    class PostController extends SessionService
    {
        public function upload(array $data)
        {
            if( !isset($data['title']) || empty($data['title']))
            {
                die("You need to write a title.");
            }

            if( !isset($data['description']) || empty($data['description']))
            {
                die("You need to write a description.");
            }

            $postModel = new Post();

            if( isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && $_FILES['image']['size'] > 0 )
            {
                echo("Upload with image. ");
            }
            else
            {
                $postModel->addPostNoImage($_POST);
                echo("Post added successfully. ");
            }
        }
    }