<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\Credentials
{
    class BasicAuth extends AbstractCredentials
    {
        /**
         * @var string
         */
        private $username;

        /**
         * @var string
         */
        private $password;

        public function __construct(string $username, string $password)
        {
            $this->username = $username;
            $this->password = $password;
        }

        public function getType(): string
        {
            return 'Basic';
        }

        public function getValue(): string
        {
            return base64_encode($this->username . ':' . $this->password);
        }
    }
}
