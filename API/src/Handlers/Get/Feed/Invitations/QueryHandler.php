<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Feed\Invitations
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Mappers\FeedUserMapper;
    use Timetabio\API\Models\Feed\FeedModel;
    use Timetabio\API\Queries\Feed\FetchInvitationsQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var FetchInvitationsQuery
         */
        private $fetchInvitationsQuery;

        /**
         * @var FeedUserMapper
         */
        private $feedUserMapper;

        public function __construct(FeedAccessControl $accessControl, FetchInvitationsQuery $fetchInvitationsQuery, FeedUserMapper $feedUserMapper)
        {
            $this->accessControl = $accessControl;
            $this->fetchInvitationsQuery = $fetchInvitationsQuery;
            $this->feedUserMapper = $feedUserMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedModel $model */

            $feedId = $model->getFeedId();
            $accessToken = $model->getAccessToken();

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed not found', 'not_found');
            }

            if (!$this->accessControl->hasWriteAccess($feedId, $accessToken)) {
                throw new Forbidden('access denied', 'access_denied');
            }

            $invitations = $this->fetchInvitationsQuery->execute($feedId);

            foreach ($invitations as $i => $invitation) {
                $invitations[$i] = $this->feedUserMapper->map($invitation);
            }

            $model->setData($invitations);
        }
    }
}
