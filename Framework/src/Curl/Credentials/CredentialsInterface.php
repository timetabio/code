<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\Credentials
{
    interface CredentialsInterface
    {
        public function getType(): string;

        public function getValue(): string;
    }
}
