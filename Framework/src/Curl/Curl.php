<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl
{
    use Timetabio\Framework\Curl\Credentials\CredentialsInterface;
    use Timetabio\Framework\Curl\RequestMethods\{
        Delete, Get, Head, Patch, Post
    };
    use Timetabio\Framework\ValueObjects\Uri;

    class Curl
    {
        /**
         * @var CurlHandler
         */
        private $handler;

        public function __construct(CurlHandler $handler)
        {
            $this->handler = $handler;
        }

        public function post(Uri $url, array $params = [], CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Post, $params, $credentials);
        }

        public function patch(Uri $url, array $params = [], CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Patch, $params, $credentials);
        }

        public function get(Uri $url, CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Get, [], $credentials);
        }

        public function delete(Uri $url, CredentialsInterface $credentials = null, array $headers = []): Response
        {
            return $this->handler->executeRequest($url, new Delete, [], $credentials, $headers);
        }

        public function head(Uri $url, CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Head, [], $credentials);
        }
    }
}
