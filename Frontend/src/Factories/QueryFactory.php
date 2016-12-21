<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class QueryFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createFetchStaticPageQuery(): \Timetabio\Frontend\Queries\FetchStaticPageQuery
        {
            return new \Timetabio\Frontend\Queries\FetchStaticPageQuery(
                $this->getMasterFactory()->createDataStoreReader()
            );
        }

        public function createIsLoggedInQuery(): \Timetabio\Frontend\Queries\IsLoggedInQuery
        {
            return new \Timetabio\Frontend\Queries\IsLoggedInQuery(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createFetchUserFeedsQuery(): \Timetabio\Frontend\Queries\FetchUserFeedsQuery
        {
            return new \Timetabio\Frontend\Queries\FetchUserFeedsQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createFetchFeedQuery(): \Timetabio\Frontend\Queries\FetchFeedQuery
        {
            return new \Timetabio\Frontend\Queries\FetchFeedQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createFetchFeedPostsQuery(): \Timetabio\Frontend\Queries\FetchFeedPostsQuery
        {
            return new \Timetabio\Frontend\Queries\FetchFeedPostsQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createLookupVanityQuery(): \Timetabio\Frontend\Queries\Feed\LookupVanityQuery
        {
            return new \Timetabio\Frontend\Queries\Feed\LookupVanityQuery(
                $this->getMasterFactory()->createDataStoreReader()
            );
        }

        public function createFetchPostQuery(): \Timetabio\Frontend\Queries\Post\FetchPostQuery
        {
            return new \Timetabio\Frontend\Queries\Post\FetchPostQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createSearchQuery(): \Timetabio\Frontend\Queries\SearchQuery
        {
            return new \Timetabio\Frontend\Queries\SearchQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createFetchUserFeedQuery(): \Timetabio\Frontend\Queries\FetchUserFeedQuery
        {
            return new \Timetabio\Frontend\Queries\FetchUserFeedQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createFetchFeedInvitationsQuery(): \Timetabio\Frontend\Queries\Feed\FetchFeedInvitationsQuery
        {
            return new \Timetabio\Frontend\Queries\Feed\FetchFeedInvitationsQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createFetchFeedUsersQuery(): \Timetabio\Frontend\Queries\Feed\FetchFeedUsersQuery
        {
            return new \Timetabio\Frontend\Queries\Feed\FetchFeedUsersQuery(
                $this->getMasterFactory()->createApiGateway()
            );
        }
    }
}
