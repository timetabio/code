<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class LoginModel extends ActionModel
    {
        /**
         * @var string
         */
        private $loginUser;

        /**
         * @var string
         */
        private $password;

        public function getLoginUser(): string
        {
            return $this->loginUser;
        }

        public function setLoginUser(string $user)
        {
            $this->loginUser = $user;
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
