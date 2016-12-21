<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\DataObjects
{
    use Timetabio\Library\ValueObjects\DisplayName;

    class User
    {
        /**
         * @var string
         */
        private $userId;

        /**
         * @var string
         */
        private $username;

        /**
         * @var string
         */
        private $name;

        public function __construct(string $userId, string $username, string $name = null)
        {
            $this->userId = $userId;
            $this->username = $username;
            $this->name = $name;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function getUsername(): string
        {
            return $this->username;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getDisplayName(): string
        {
            return new DisplayName([
                'name' => $this->name,
                'username' => $this->username
            ]);
        }
    }
}
