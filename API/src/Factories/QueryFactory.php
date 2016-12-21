<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class QueryFactory extends AbstractChildFactory
    {
        public function createFetchUserByEmailQuery(): \Timetabio\API\Queries\User\FetchUserByEmailQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserByEmailQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchVerificationTokenQuery(): \Timetabio\API\Queries\User\FetchVerificationTokenQuery
        {
            return new \Timetabio\API\Queries\User\FetchVerificationTokenQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchUserByIdQuery(): \Timetabio\API\Queries\User\FetchUserByIdQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserByIdQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchUserByUsernameQuery(): \Timetabio\API\Queries\User\FetchUserByUsernameQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserByUsernameQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchProfileQuery(): \Timetabio\API\Queries\Profile\FetchProfileQuery
        {
            return new \Timetabio\API\Queries\Profile\FetchProfileQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchUsernameQuery(): \Timetabio\API\Queries\User\FetchUsernameQuery
        {
            return new \Timetabio\API\Queries\User\FetchUsernameQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchAuthUserQuery(): \Timetabio\API\Queries\User\FetchAuthUserQuery
        {
            return new \Timetabio\API\Queries\User\FetchAuthUserQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchUserPasswordQuery(): \Timetabio\API\Queries\User\FetchUserPasswordQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserPasswordQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchCollectionQuery(): \Timetabio\API\Queries\FetchCollectionQuery
        {
            return new \Timetabio\API\Queries\FetchCollectionQuery(
                $this->getMasterFactory()->createCollectionService()
            );
        }

        public function createIsInvitedQuery(): \Timetabio\API\Queries\User\IsInvitedQuery
        {
            return new \Timetabio\API\Queries\User\IsInvitedQuery(
                $this->getMasterFactory()->createBetaRequestService()
            );
        }

        public function createFetchFeedsQuery(): \Timetabio\API\Queries\Feeds\FetchFeedsQuery
        {
            return new \Timetabio\API\Queries\Feeds\FetchFeedsQuery(
                $this->getMasterFactory()->createFeedService()
            );
        }

        public function createFetchFeedQuery(): \Timetabio\API\Queries\Feeds\FetchFeedQuery
        {
            return new \Timetabio\API\Queries\Feeds\FetchFeedQuery(
                $this->getMasterFactory()->createFeedService()
            );
        }

        public function createFetchUserFeedsQuery(): \Timetabio\API\Queries\User\FetchUserFeedsQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserFeedsQuery(
                $this->getMasterFactory()->createSearchBackend()
            );
        }

        public function createFetchFollowerQuery(): \Timetabio\API\Queries\Feeds\FetchFollowerQuery
        {
            return new \Timetabio\API\Queries\Feeds\FetchFollowerQuery(
                $this->getMasterFactory()->createFollowerService()
            );
        }

        public function createFetchUserCollectionsQuery(): \Timetabio\API\Queries\User\FetchUserCollectionsQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserCollectionsQuery(
                $this->getMasterFactory()->createCollectionService()
            );
        }

        public function createFetchPersonQuery(): \Timetabio\API\Queries\Feeds\FetchPersonQuery
        {
            return new \Timetabio\API\Queries\Feeds\FetchPersonQuery(
                $this->getMasterFactory()->createPeopleService()
            );
        }

        public function createFetchPeopleQuery(): \Timetabio\API\Queries\Feeds\FetchPeopleQuery
        {
            return new \Timetabio\API\Queries\Feeds\FetchPeopleQuery(
                $this->getMasterFactory()->createPeopleService()
            );
        }

        public function createFetchFeedPostsQuery(): \Timetabio\API\Queries\Posts\FetchFeedPostsQuery
        {
            return new \Timetabio\API\Queries\Posts\FetchFeedPostsQuery(
                $this->getMasterFactory()->createSearchBackend()
            );
        }

        public function createFetchPostQuery(): \Timetabio\API\Queries\Posts\FetchPostQuery
        {
            return new \Timetabio\API\Queries\Posts\FetchPostQuery(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createDataStoreReader()
            );
        }

        public function createFetchVerificationTokenByEmailQuery(): \Timetabio\API\Queries\User\FetchVerificationTokenByEmailQuery
        {
            return new \Timetabio\API\Queries\User\FetchVerificationTokenByEmailQuery(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createFetchUpcomingEventsQuery(): \Timetabio\API\Queries\User\FetchUpcomingEventsQuery
        {
            return new \Timetabio\API\Queries\User\FetchUpcomingEventsQuery(
                $this->getMasterFactory()->createPostService()
            );
        }

        public function createFetchUserTodoTasksQuery(): \Timetabio\API\Queries\User\FetchTodoTasksQuery
        {
            return new \Timetabio\API\Queries\User\FetchTodoTasksQuery(
                $this->getMasterFactory()->createPostService()
            );
        }

        public function createFetchPostInfoQuery(): \Timetabio\API\Queries\Post\FetchPostInfoQuery
        {
            return new \Timetabio\API\Queries\Post\FetchPostInfoQuery(
                $this->getMasterFactory()->createPostService()
            );
        }

        public function createFetchVanityByNameQuery(): \Timetabio\API\Queries\Feed\FetchVanityByNameQuery
        {
            return new \Timetabio\API\Queries\Feed\FetchVanityByNameQuery(
                $this->getMasterFactory()->createFeedService()
            );
        }

        public function createFeedExistsQuery(): \Timetabio\API\Queries\Feed\FeedExistsQuery
        {
            return new \Timetabio\API\Queries\Feed\FeedExistsQuery(
                $this->getMasterFactory()->createDataStoreReader()
            );
        }

        public function createFetchFileByPublicIdQuery(): \Timetabio\API\Queries\File\FetchFileByPublicIdQuery
        {
            return new \Timetabio\API\Queries\File\FetchFileByPublicIdQuery(
                $this->getMasterFactory()->createFileService()
            );
        }

        public function createFetchPostAttachmentsQuery(): \Timetabio\API\Queries\Post\FetchPostAttachmentsQuery
        {
            return new \Timetabio\API\Queries\Post\FetchPostAttachmentsQuery(
                $this->getMasterFactory()->createPostService()
            );
        }

        public function createFetchBetaRequestByEmailQuery(): \Timetabio\API\Queries\BetaRequest\FetchBetaRequestByEmailQuery
        {
            return new \Timetabio\API\Queries\BetaRequest\FetchBetaRequestByEmailQuery(
                $this->getMasterFactory()->createBetaRequestService()
            );
        }

        public function createFetchInvitationQuery(): \Timetabio\API\Queries\Feed\FetchInvitationQuery
        {
            return new \Timetabio\API\Queries\Feed\FetchInvitationQuery(
                $this->getMasterFactory()->createFeedInvitationService()
            );
        }

        public function createInvitationExistsQuery(): \Timetabio\API\Queries\Feed\InvitationExistsQuery
        {
            return new \Timetabio\API\Queries\Feed\InvitationExistsQuery(
                $this->getMasterFactory()->createFeedInvitationService()
            );
        }

        public function createFetchInvitationsQuery(): \Timetabio\API\Queries\Feed\FetchInvitationsQuery
        {
            return new \Timetabio\API\Queries\Feed\FetchInvitationsQuery(
                $this->getMasterFactory()->createFeedInvitationService()
            );
        }

        public function createFetchFeedUserQuery(): \Timetabio\API\Queries\Feed\FetchFeedUserQuery
        {
            return new \Timetabio\API\Queries\Feed\FetchFeedUserQuery(
                $this->getMasterFactory()->createPeopleService()
            );
        }

        public function createSearchQuery(): \Timetabio\API\Queries\SearchQuery
        {
            return new \Timetabio\API\Queries\SearchQuery(
                $this->getMasterFactory()->createSearchBackend()
            );
        }

        public function createFetchUserFeedQuery(): \Timetabio\API\Queries\User\FetchUserFeedQuery
        {
            return new \Timetabio\API\Queries\User\FetchUserFeedQuery(
                $this->getMasterFactory()->createSearchBackend()
            );
        }

        public function createFetchFeedVanityQuery(): \Timetabio\API\Queries\Feed\FetchFeedVanityQuery
        {
            return new \Timetabio\API\Queries\Feed\FetchFeedVanityQuery(
                $this->getMasterFactory()->createDataStoreReader()
            );
        }
    }
}
