<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Feed\Follow
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\FollowModel;
    use Timetabio\API\Queries\Feed\FetchInvitationQuery;
    use Timetabio\API\Queries\Feeds\FetchFollowerQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Locators\UserRoleLocator;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFollowerQuery
         */
        private $fetchFollowerQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var FetchInvitationQuery
         */
        private $fetchInvitationQuery;

        /**
         * @var UserRoleLocator
         */
        private $userRoleLocator;

        public function __construct(FetchFollowerQuery $fetchFollowerQuery, FeedAccessControl $accessControl, FetchInvitationQuery $fetchInvitationQuery, UserRoleLocator $userRoleLocator)
        {
            $this->fetchFollowerQuery = $fetchFollowerQuery;
            $this->accessControl = $accessControl;
            $this->fetchInvitationQuery = $fetchInvitationQuery;
            $this->userRoleLocator = $userRoleLocator;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FollowModel $model */

            $feedId = $model->getFeedId();
            $token = $model->getAccessToken();

            $invitation = $this->fetchInvitationQuery->execute($model->getFeedId(), $model->getAuthUserId());

            if (!$this->accessControl->hasFollowAccess($feedId, $token) && $invitation === null) {
                throw new NotFound('feed not found', 'not_found');
            }

            $follower = $this->fetchFollowerQuery->execute($feedId, $model->getAuthUserId());

            if ($follower !== null) {
                $model->setFollowing(true);
            }

            if ($invitation !== null) {
                $model->setRole($this->userRoleLocator->locate($invitation['role']));
            }
        }
    }
}
