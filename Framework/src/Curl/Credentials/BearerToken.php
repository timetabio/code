<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\Credentials
{
    class BearerToken extends AbstractCredentials
    {
        /**
         * @var string
         */
        private $token;

        public function __construct(string $token)
        {
            $this->token = $token;
        }

        public function getType(): string
        {
            return 'Bearer';
        }

        public function getValue(): string
        {
            return $this->token;
        }
    }
}
