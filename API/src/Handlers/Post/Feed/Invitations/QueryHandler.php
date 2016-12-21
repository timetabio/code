<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Feed\Invitations
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Queries\Feed\FetchFeedUserQuery;
    use Timetabio\API\Queries\Feed\InvitationExistsQuery;
    use Timetabio\API\Queries\User\FetchUserByIdQuery;
    use Timetabio\API\Queries\User\FetchUserByUsernameQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var InvitationExistsQuery
         */
        private $invitationExistsQuery;

        /**
         * @var FetchFeedUserQuery
         */
        private $fetchFeedUserQuery;

        /**
         * @var FetchUserByUsernameQuery
         */
        private $fetchUserByUsernameQuery;

        public function __construct(
            FeedAccessControl $accessControl,
            InvitationExistsQuery $invitationExistsQuery,
            FetchFeedUserQuery $fetchFeedUserQuery,
            FetchUserByUsernameQuery $fetchUserByUsernameQuery
        )
        {
            $this->accessControl = $accessControl;
            $this->invitationExistsQuery = $invitationExistsQuery;
            $this->fetchFeedUserQuery = $fetchFeedUserQuery;
            $this->fetchUserByUsernameQuery = $fetchUserByUsernameQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var \Timetabio\API\Models\Feed\Invitation\CreateModel $model */

            $feedId = $model->getInvitationFeedId();
            $username = $model->getInvitationUsername();
            $accessToken = $model->getAccessToken();

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed not found', 'not_found');
            }

            if (!$this->accessControl->hasWriteAccess($feedId, $accessToken)) {
                throw new Forbidden('access denied', 'access_denied');
            }

            $user = $this->fetchUserByUsernameQuery->execute($username);

            if ($user === null) {
                throw new BadRequest('user does not exist', 'user_not_found');
            }

            if ($this->invitationExistsQuery->execute($feedId, $user['id'])) {
                throw new BadRequest('invitation already exists', 'invitation_exists');
            }

            if ($this->fetchFeedUserQuery->execute($feedId, $user['id']) !== null) {
                throw new BadRequest('user is already added to feed', 'already_added');
            }

            $model->setInvitationUserId($user['id']);
        }
    }
}
