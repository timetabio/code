<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\Credentials
{
    abstract class AbstractCredentials implements CredentialsInterface
    {
        public function __toString(): string
        {
            return $this->getType() . ' ' . $this->getValue();
        }
    }
}
