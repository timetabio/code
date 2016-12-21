<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Feed\People
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Mappers\FeedUserMapper;
    use Timetabio\API\Models\Feed\People\ListModel;
    use Timetabio\API\Queries\Feeds\FetchPeopleQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchPeopleQuery
         */
        private $fetchPeopleQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var FeedUserMapper
         */
        private $feedUserMapper;

        public function __construct(
            FetchPeopleQuery $fetchPeopleQuery,
            FeedAccessControl $accessControl,
            FeedUserMapper $feedUserMapper
        )
        {
            $this->fetchPeopleQuery = $fetchPeopleQuery;
            $this->accessControl = $accessControl;
            $this->feedUserMapper = $feedUserMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $feedId = $model->getFeedId();
            $accessToken = null;

            if ($model->hasAccessToken()) {
                $accessToken = $model->getAccessToken();
            }

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed not found', 'not_found');
            }

            $users = $this->fetchPeopleQuery->execute($feedId);

            foreach ($users as $i => $user) {
                $user['meta']['is_modifiable'] = $this->accessControl->canModifyFeedUser($feedId, $user['user_id'], $accessToken);
                $users[$i] = $this->feedUserMapper->map($user);
            }

            $model->setData($users);
        }
    }
}
