<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ApplicationFactory extends AbstractChildFactory
    {
        public function createUriBuilder(): \Timetabio\Library\Builders\UriBuilder
        {
            return new \Timetabio\Library\Builders\UriBuilder(
                $this->getMasterFactory()->createDataStoreReader(),
                $this->getMasterFactory()->getConfiguration()->get('uriHost')
            );
        }
    }
}
