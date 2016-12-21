<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class MapperFactory extends AbstractChildFactory
    {
        public function createFeedUserMapper(): \Timetabio\API\Mappers\FeedUserMapper
        {
            return new \Timetabio\API\Mappers\FeedUserMapper(
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createPostAttachmentMapper(): \Timetabio\API\Mappers\PostAttachmentMapper
        {
            return new \Timetabio\API\Mappers\PostAttachmentMapper(
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createSearchResultsMapper(): \Timetabio\API\Mappers\SearchResultsMapper
        {
            return new \Timetabio\API\Mappers\SearchResultsMapper;
        }

        public function createResultsMapper(): \Timetabio\API\Mappers\ResultsMapper
        {
            return new \Timetabio\API\Mappers\ResultsMapper;
        }
    }
}
