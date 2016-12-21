<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class RegisterModel extends ActionModel
    {
        /**
         * @var string
         */
        private $email;

        /**
         * @var string
         */
        private $username;

        /**
         * @var string
         */
        private $password;

        public function getEmail(): string
        {
            return $this->email;
        }

        public function setEmail(string $email)
        {
            $this->email = $email;
        }

        public function getUsername(): string
        {
            return $this->username;
        }

        public function setUsername(string $username)
        {
            $this->username = $username;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function setPassword(string $password)
        {
            $this->password = $password;
        }
    }
}
