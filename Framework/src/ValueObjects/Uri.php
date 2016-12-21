<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class Uri
    {
        /**
         * @var string
         */
        private $scheme = '';

        /**
         * @var string
         */
        private $host = '';

        /**
         * @var string
         */
        private $path = '/';

        /**
         * @var array
         */
        private $query = [];

        public function __construct(string $uri)
        {
            $parsed = parse_url($uri);

            if (isset($parsed['path'])) {
                $this->path = $parsed['path'];
            }

            if (isset($parsed['scheme'])) {
                $this->scheme = $parsed['scheme'];
            }

            if (isset($parsed['host'])) {
                $this->host = $parsed['host'];
            }

            if (isset($parsed['query'])) {
                parse_str($parsed['query'], $this->query);
            }
        }

        public function getScheme(): string
        {
            return $this->scheme;
        }

        public function getHost(): string
        {
            return $this->host;
        }

        public function getPath(): string
        {
            return $this->path;
        }

        public function getExplodedPath(): array
        {
            return array_slice(explode('/', $this->path), 1);
        }

        public function getQueryParam(string $parameter)
        {
            if (!isset($this->query[$parameter])) {
                throw new \Exception('query param "' . $parameter . '" not found');
            }

            return $this->query[$parameter];
        }

        public function hasQueryParam(string $parameter): bool
        {
            return isset($this->query[$parameter]);
        }

        public function __toString()
        {
            $scheme = $this->scheme;
            $query = '';

            if (!empty($this->query)) {
                $query = '?' . http_build_query($this->query);
            }

            if ($scheme !== '') {
                $scheme .= ':';
            }

            if ($this->host !== '') {
                $scheme .= '//';
            }

            return $scheme . $this->host . $this->path . $query;
        }
    }
}
