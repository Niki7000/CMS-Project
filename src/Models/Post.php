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

        public function getAllFilteredPosts(array $data): array
        {
            if((!empty($data['category'])) && (!isset($data['tag']) || empty($data['tag'])))
            {
                $stmt = $this->connection->prepare("SELECT * FROM posts WHERE category=:category ORDER BY date DESC");
                $stmt->bindParam(":category", $data['category']);
                $stmt->execute();
                return $stmt->fetchAll();
            }

            $tag = strtolower($data['tag']);

            if((!empty($data['tag'])) && (!isset($data['category']) || empty($data['category'])))
            {
                $stmt = $this->connection->prepare("SELECT * FROM posts WHERE tags LIKE '%$tag%' ORDER BY date DESC");
                $stmt->execute();
                return $stmt->fetchAll();
            }

            $stmt = $this->connection->prepare("SELECT * FROM posts WHERE category=:category AND tags LIKE '%$tag%' ORDER BY date DESC");
            $stmt->bindParam(":category", $data['category']);
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }