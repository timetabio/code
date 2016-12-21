<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class MapperFactory extends AbstractChildFactory
    {
        public function createDocumentMapper(): \Timetabio\Library\Mappers\DocumentMapper
        {
            return new \Timetabio\Library\Mappers\DocumentMapper;
        }

        public function createPostMapper():  \Timetabio\Library\Mappers\PostMapper
        {
            return new \Timetabio\Library\Mappers\PostMapper(
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createFeedMapper():  \Timetabio\Library\Mappers\FeedMapper
        {
            return new \Timetabio\Library\Mappers\FeedMapper(
                $this->getMasterFactory()->createDocumentMapper()
            );
        }
    }
}
