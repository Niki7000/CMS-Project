<?php

    namespace CMS\Models;

    class Post extends DB
    {
        public function getAllPosts(): array
        {
            $stmt = $this->connection->prepare("SELECT * FROM posts");
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }