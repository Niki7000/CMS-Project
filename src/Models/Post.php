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

        
        public function postExists(int $id): bool
        {
            $stmt = $this->connection->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        }
        

        public function getPostsById(int $id): array
        {
            $stmt = $this->connection->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->fetch();
        }

        public function addPostNoImage(array $data): void
        {
            $stmt = $this->connection->prepare("INSERT INTO posts(title, description, category, tags, date, UserID) VALUES (:title,:desc,:category,:tags,:date,:userID)");
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":desc", $data['description']);
            $stmt->bindParam(":category", $data['category']);
            $stmt->bindParam(":tags", $data['tags']);
            $date = date("Y-m-d");
            $stmt->bindParam(":date", $date);
            $userID = 5;
            $stmt->bindParam(":userID", $userID);
            
            $stmt->execute();
        }

        public function addPostImage(array $data): void
        {

        }
    }