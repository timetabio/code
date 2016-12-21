<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Configuration
{
    use Timetabio\Framework\Map\ReadableMapInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    interface ConfigurationInterface extends ReadableMapInterface
    {
        public function isDevelopmentMode(): bool;

        public function getRedisHost(): string;

        public function getRedisPort(): int;

        public function getSlackEndpoint(): Uri;
    }
}
