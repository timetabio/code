<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Post
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Post\PostModel;
    use Timetabio\API\Queries\Post\FetchPostInfoQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchPostInfoQuery
         */
        private $fetchPostInfoQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        public function __construct(FetchPostInfoQuery $fetchPostInfoQuery, FeedAccessControl $accessControl)
        {
            $this->fetchPostInfoQuery = $fetchPostInfoQuery;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $post = $this->fetchPostInfoQuery->execute($model->getPostId());

            // TODO: change access control

            if ($post === null || !$this->accessControl->hasPostAccess($post['feed_id'], $model->getAccessToken())) {
                throw new NotFound('post not found', 'not_found');
            }
        }
    }
}
