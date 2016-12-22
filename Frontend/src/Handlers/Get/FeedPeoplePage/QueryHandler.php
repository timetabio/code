<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\FeedPeoplePage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Queries\Feed\FetchFeedInvitationsQuery;
    use Timetabio\Frontend\Queries\Feed\FetchFeedUsersQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedUsersQuery
         */
        private $fetchFeedUsersQuery;

        /**
         * @var FetchFeedInvitationsQuery
         */
        private $fetchFeedInvitationsQuery;

        public function __construct(
            FetchFeedUsersQuery $fetchFeedUsersQuery,
            FetchFeedInvitationsQuery $fetchFeedInvitationsQuery
        )
        {
            $this->fetchFeedUsersQuery = $fetchFeedUsersQuery;
            $this->fetchFeedInvitationsQuery = $fetchFeedInvitationsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var \Timetabio\Frontend\Models\Page\FeedPeoplePageModel $model */

            $feed = $model->getFeed();
            $feedId = $feed->getId();

            if ($feed->hasUsersManageAccess()) {
                $model->setFeedInvitations(
                    $this->fetchFeedInvitationsQuery->execute($feedId)
                );
            }

            $users = $this->fetchFeedUsersQuery->execute($feedId);

            if ($users !== null) {
                $model->setFeedUsers($users);
            }
        }
    }
}
