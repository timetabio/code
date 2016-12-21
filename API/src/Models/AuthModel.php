<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;

    class AuthModel extends APIModel
    {
        /**
         * @var string
         */
        private $user;

        /**
         * @var string
         */
        private $password;

        /**
         * @var AccessTypeInterface
         */
        private $accessType;

        /**
         * @var bool
         */
        private $autoRenew = false;

        public function getUser(): string
        {
            return $this->user;
        }

        public function setUser(string $user)
        {
            $this->user = $user;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function setPassword(string $password)
        {
            $this->password = $password;
        }

        public function getAccessType(): AccessTypeInterface
        {
            return $this->accessType;
        }

        public function setAccessType(AccessTypeInterface $accessType)
        {
            $this->accessType = $accessType;
        }

        public function setAutoRenew(bool $autoRenew)
        {
            $this->autoRenew = $autoRenew;
        }

        public function getAutoRenew(): bool
        {
            return $this->autoRenew;
        }
    }
}
