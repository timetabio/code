<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\FeedPostsFragment
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Fragment\FeedPostsFragmentModel;
    use Timetabio\Frontend\Queries\FetchFeedPostsQuery;
    use Timetabio\Frontend\Queries\FetchFeedQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedQuery
         */
        private $fetchFeedQuery;

        /**
         * @var FetchFeedPostsQuery
         */
        private $fetchFeedPostsQuery;

        public function __construct(FetchFeedQuery $fetchFeedQuery, FetchFeedPostsQuery $fetchFeedPostsQuery)
        {
            $this->fetchFeedQuery = $fetchFeedQuery;
            $this->fetchFeedPostsQuery = $fetchFeedPostsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedPostsFragmentModel $model */

            $model->setFeed($this->fetchFeedQuery->execute(
                $model->getFeedId()
            ));

            $model->setPosts($this->fetchFeedPostsQuery->execute(
                $model->getFeedId(),
                $model->getLimit(),
                $model->getPage()
            ));
        }
    }
}
