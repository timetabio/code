<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ApplicationFactory extends AbstractChildFactory
    {
        public function createUriBuilder(): \Timetabio\Survey\Builders\UriBuilder
        {
            return new \Timetabio\Survey\Builders\UriBuilder(
                $this->getMasterFactory()->getConfiguration()->get('uriHost')
            );
        }
    }
}
