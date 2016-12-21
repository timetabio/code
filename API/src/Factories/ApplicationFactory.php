<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ApplicationFactory extends AbstractChildFactory
    {
        public function createAccessControl(): \Timetabio\API\Access\AccessControl
        {
            return new \Timetabio\API\Access\AccessControl(
                $this->getMasterFactory()->createDataStoreReader(),
                $this->getMasterFactory()->createRequestTokenReader()
            );
        }

        public function createDataStoreReader(): \Timetabio\API\DataStore\DataStoreReader
        {
            return new \Timetabio\API\DataStore\DataStoreReader(
                $this->getMasterFactory()->createRedisBackend()
            );
        }

        public function createDataStoreWriter(): \Timetabio\API\DataStore\DataStoreWriter
        {
            return new \Timetabio\API\DataStore\DataStoreWriter(
                $this->getMasterFactory()->createRedisBackend()
            );
        }

        public function createRequestTokenReader(): \Timetabio\API\Readers\RequestTokenReader
        {
            return new \Timetabio\API\Readers\RequestTokenReader;
        }

        public function createFeedAccessControl(): \Timetabio\API\Access\AccessControl\FeedAccessControl
        {
            return new \Timetabio\API\Access\AccessControl\FeedAccessControl(
                $this->getMasterFactory()->createDataStoreReader()
            );
        }

        public function createCollectionAccessControl(): \Timetabio\API\Access\AccessControl\CollectionAccessControl
        {
            return new \Timetabio\API\Access\AccessControl\CollectionAccessControl;
        }

        public function createPostTypeLocator(): \Timetabio\API\Locators\PostTypeLocator
        {
            return new \Timetabio\API\Locators\PostTypeLocator;
        }

        public function createUriBuilder(): \Timetabio\API\Builders\UriBuilder
        {
            return new \Timetabio\API\Builders\UriBuilder(
                $this->getMasterFactory()->createS3HelperUriBuilder()
            );
        }

        public function createSearchBackend(): \Timetabio\API\Backends\SearchBackend
        {
            return new \Timetabio\API\Backends\SearchBackend(
                $this->getMasterFactory()->createElasticBackend()
            );
        }
    }
}
