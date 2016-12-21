<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Request
{
    use Timetabio\Framework\Http\Headers\Authorization;
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    abstract class AbstractRequest implements RequestInterface
    {
        /**
         * @var Uri
         */
        private $uri;

        /**
         * @var array
         */
        private $server;

        /**
         * @var array
         */
        private $cookies;

        public function __construct(Uri $uri, array $server, array $cookies)
        {
            $this->uri = $uri;
            $this->server = $server;
            $this->cookies = $cookies;
        }

        public function getUri(): Uri
        {
            return $this->uri;
        }

        public function getQueryParam(string $param): string
        {
            return $this->uri->getQueryParam($param);
        }

        public function hasQueryParam(string $param): bool
        {
            return $this->uri->hasQueryParam($param);
        }

        public function getUserAgent(): string
        {
            return $this->server['HTTP_USER_AGENT'];
        }

        public function getUserIp(): string
        {
            return $this->server['REMOTE_ADDR'];
        }

        public function getAuthorization(): Authorization
        {
            return new Authorization($this->server['HTTP_AUTHORIZATION']);
        }

        public function hasAuthorization(): bool
        {
            try {
                $this->getAuthorization();
                return true;
            } catch (\Throwable $e) {
                return false;
            }
        }

        public function hasCookie(string $name): bool
        {
            return isset($this->cookies[$name]);
        }

        public function getCookie(string $name): string
        {
            if (!isset($this->cookies[$name])) {
                throw new \Exception('cookie with name "' . $name . '" not found');
            }

            return $this->cookies[$name];
        }

        public function getLanguage(): LanguageInterface
        {
            // $header = new \http\Header('Accept-Language', $this->server['HTTP_ACCEPT_LANGUAGE'] ?? '');
            // $language = $header->negotiate(['en', 'de']);

            // switch ($language) {
            //    case 'de':
            //        return new \Timetabio\Framework\Languages\German;
            // }

            return new \Timetabio\Framework\Languages\English;
        }

        public function isDnt(): bool
        {
            if (!isset($this->server['HTTP_DNT'])) {
                return false;
            }

            return $this->server['HTTP_DNT'] === '1';
        }
    }
}
