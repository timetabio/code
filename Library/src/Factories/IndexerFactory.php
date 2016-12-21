<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class IndexerFactory extends AbstractChildFactory
    {
        public function createFeedIndexer(): \Timetabio\Library\Indexers\FeedIndexer
        {
            return new \Timetabio\Library\Indexers\FeedIndexer(
                $this->getMasterFactory()->createElasticBackend()
            );
        }

        public function createPostIndexer(): \Timetabio\Library\Indexers\PostIndexer
        {
            return new \Timetabio\Library\Indexers\PostIndexer(
                $this->getMasterFactory()->createElasticBackend()
            );
        }

        public function createUserIndexer(): \Timetabio\Library\Indexers\UserIndexer
        {
            return new \Timetabio\Library\Indexers\UserIndexer(
                $this->getMasterFactory()->createElasticBackend()
            );
        }
    }
}
