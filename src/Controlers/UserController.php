<?php

    namespace CMS\Controlers;

    use CMS\Models\User;
    use CMS\Services\SessionService;

    class UserController extends SessionService
    {
        public function login(array $data): void
        {
            if( !isset($data['email']) || empty($data['email']) )
            {
                die("Error: You didn't enter email.");
            }

            if( !isset($data['password']) || empty($data['password']) )
            {
                die("Error: You didn't enter password.");
            }

            $userModel = new User();

            if( !$userModel->userExists($data['email']) )
            {
                die("This user doesnt exist.");
            }

            $user = $userModel->getUserByEmail($data['email']);

            if( !password_verify($data['password'], $user['password']) )
            {
                die("Wrong password.");
            }

            $this->setSession("userId", $user["id"]);
            $this->setSession("loggedIn", true);
            if($user['role'] == 'admin')
            {
                $this->setSession('role', 'admin');
            }
            else
            {
                $this->setSession("role", "editor");
            }
            header('Location: home.php');
        }

        public function register(array $data): void
        {
            if( !isset($data['email']) || empty($data['email']))
            {
                die("You didn't enter your email address.");
            }

            $userModel = new User();

            if($userModel->userExists($data['email']))
            {
                die("This user already exists. ");
            }

            if( !isset($data['name']) || empty($data['name']) )
            {
                die("You didn't enter your name. ");
            }
            if( !isset($data['password']) || empty($data['password']) )
            {
                die("You didn't enter your password. ");
            }
            if( !isset($data['confirmPassword']) || empty($data['confirmPassword']) )
            {
                die("You didn't confirm your password. ");
            }
            if( $data['password'] !== $data['confirmPassword'] )
            {
                die("Confirm password doesn't match original password. ");
            }
            if( !isset($data['role']) || empty($data['role']) )
            {
                die("You didn't enter your role. ");
            }
            
            $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $userModel->addNewUser($data['email'], $password, $data['name'], $data['role']);
            $user = $userModel->getUserByEmail($data['email']);
            
            $this->setSession("userId", $user["id"]);
            $this->setSession("loggedIn", true);
            if($data['role'] == 'admin')
            {
                $this->setSession('role', 'admin');
            }
            else
            {
                $this->setSession('role', 'editor');
            }
            header('Location: home.php');
        }

        public function logout(): void
        {
            unset($_SESSION['userId']);
            unset($_SESSION['loggedIn']);
            unset($_SESSION['role']);
        }
    }