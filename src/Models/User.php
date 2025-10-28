<?php

    namespace CMS\Models;

    class User extends DB
    {
        public function userExists(string $email): bool
        {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
         
            return $stmt->rowCount() > 0;
        }

        public function getUserByEmail(string $email): array
        {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            return $stmt->fetch();
        }

        public function addNewUser(string $email, string $password, string $name, string $role): void
        {
            $stmt = $this->connection->prepare("INSERT INTO users(email, password, name, role) VALUES (:email, :password, :name, :role)");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
        }
    }