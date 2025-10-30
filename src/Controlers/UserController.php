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

            echo "You have successfully logged in.";
            $this->setSession("userId", $user["id"]);
            $this->setSession("loggedIn", true);
        }

        public function register(array $data): void
        {

        }
    }