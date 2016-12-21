<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\User\Feeds
{
    use Timetabio\API\Mappers\ResultsMapper;
    use Timetabio\API\Models\ListModel;
    use Timetabio\API\Queries\User\FetchUserFeedsQuery;
    use Timetabio\API\ValueObjects\Pagination;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserFeedsQuery
         */
        private $fetchUserFeedsQuery;

        /**
         * @var ResultsMapper
         */
        private $resultsMapper;

        public function __construct(FetchUserFeedsQuery $fetchUserFeedsQuery, ResultsMapper $resultsMapper)
        {
            $this->fetchUserFeedsQuery = $fetchUserFeedsQuery;
            $this->resultsMapper = $resultsMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();
            $userId = $model->getAuthUserId();

            $feeds = $this->fetchUserFeedsQuery->execute($userId, $limit, $page);

            $model->setData(new Pagination(
                $limit,
                $page,
                $feeds['hits']['total'],
                $this->resultsMapper->map($feeds)
            ));
        }
    }
}
