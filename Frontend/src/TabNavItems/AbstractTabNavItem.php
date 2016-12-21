<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems
{
    abstract class AbstractTabNavItem implements TabNavItem
    {
        /**
         * @var string
         */
        private $uri;

        public function __construct(string $uri)
        {
            $this->uri = $uri;
        }

        public function getUri(): string
        {
            return $this->uri;
        }
    }
}
