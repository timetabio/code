<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\User\Upcoming
{
    use Timetabio\API\Models\ListModel;
    use Timetabio\API\Queries\User\FetchUpcomingEventsQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\PostMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUpcomingEventsQuery
         */
        private $fetchUpcomingEventsQuery;

        /**
         * @var PostMapper
         */
        private $postMapper;

        public function __construct(FetchUpcomingEventsQuery $fetchUpcomingEventsQuery, PostMapper $postMapper)
        {
            $this->fetchUpcomingEventsQuery = $fetchUpcomingEventsQuery;
            $this->postMapper = $postMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();
            $userId = $model->getAuthUserId();

            $posts = $this->fetchUpcomingEventsQuery->execute($userId, $limit, $page);

            foreach ($posts as $i => $post) {
                $posts[$i] = $this->postMapper->map($post);
            }

            $model->setData([
                'pagination' => [
                    'limit' => $limit,
                    'page' => $page
                ],
                'posts' => $posts
            ]);
        }
    }
}
