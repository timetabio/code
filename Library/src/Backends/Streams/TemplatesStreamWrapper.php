<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Backends\Streams
{
    use Timetabio\Framework\Backends\Streams\AbstractStreamWrapper;

    class TemplatesStreamWrapper extends AbstractStreamWrapper
    {
        /**
         * @var string
         */
        private static $basePath;

        protected static function getProtocol(): string
        {
            return 'templates';
        }

        protected static function getBasePath(): string
        {
            return self::$basePath;
        }

        protected static function setBasePath(string $basePath)
        {
            self::$basePath = $basePath;
        }
    }
}
