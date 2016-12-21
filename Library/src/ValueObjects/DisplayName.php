<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\ValueObjects
{
    class DisplayName
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(array $user)
        {
            $this->value = $this->parse($user);
        }

        private function parse(array $user): string
        {
            if (isset($user['name']) && $user['name'] !== '') {
                return $user['name'];
            }

            return '@' . $user['username'];
        }

        public function __toString(): string
        {
            return $this->value;
        }
    }
}
