<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Configuration
{
    use Timetabio\Framework\ValueObjects\Uri;

    class Configuration implements ConfigurationInterface
    {
        /**
         * @var string
         */
        private $fileName;

        /**
         * @var bool
         */
        private $isLoaded = false;

        /**
         * @var array
         */
        private $data;

        public function __construct(string $fileName)
        {
            $this->fileName = $fileName;
        }

        public function has(string $key): bool
        {
            $this->load();

            return isset($this->data[$key]);
        }

        public function get(string $key)
        {
            $this->load();

            if (!isset($this->data[$key])) {
                throw new \Exception('configuration key "' . $key . '" not found');
            }

            return $this->data[$key];
        }

        public function isDevelopmentMode(): bool
        {
            return $this->get('isDevelopmentMode');
        }

        public function getRedisHost(): string
        {
            return $this->get('redisHost');
        }

        public function getRedisPort(): int
        {
            return $this->get('redisPort');
        }

        public function getSlackEndpoint(): Uri
        {
            return new Uri($this->get('slackEndpoint'));
        }

        private function load()
        {
            if ($this->isLoaded) {
                return;
            }

            try {
                $this->data = parse_ini_file($this->fileName, false, INI_SCANNER_TYPED);
            } catch (\Throwable $e) {
                throw new \Exception('error parsing configuration file "' . $this->fileName . '"', 0, $e);
            }

            $this->isLoaded = true;
        }
    }
}
