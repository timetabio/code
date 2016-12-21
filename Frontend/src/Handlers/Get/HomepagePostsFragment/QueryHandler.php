<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\HomepagePostsFragment
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Fragment\HomepagePostsFragmentModel;
    use Timetabio\Frontend\Queries\FetchUserFeedQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserFeedQuery
         */
        private $fetchUserFeedQuery;

        public function __construct(FetchUserFeedQuery $fetchUserFeedQuery)
        {
            $this->fetchUserFeedQuery = $fetchUserFeedQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var HomepagePostsFragmentModel $model */

            $model->setPosts($this->fetchUserFeedQuery->execute(
                $model->getLimit(),
                $model->getPage()
            ));
        }
    }
}
