<?php

    namespace CMS\Models;

    class Post extends DB
    {
        public function getAllPosts(): array
        {
            $stmt = $this->connection->prepare("SELECT * FROM posts ORDER BY date DESC");
            $stmt->execute();

            return $stmt->fetchAll();
        }

        public function getAllCategoires(): array
        {
            $stmt = $this->connection->prepare("SELECT DISTINCT category FROM posts WHERE category IS NOT NULL;");
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }