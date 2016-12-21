<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Search
{
    use Timetabio\API\Mappers\SearchResultsMapper;
    use Timetabio\API\Models\SearchModel;
    use Timetabio\API\Queries\SearchQuery;
    use Timetabio\API\ValueObjects\Pagination;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var SearchQuery
         */
        private $searchQuery;

        /**
         * @var SearchResultsMapper
         */
        private $searchResultsMapper;

        public function __construct(SearchQuery $searchQuery, SearchResultsMapper $searchResultsMapper)
        {
            $this->searchQuery = $searchQuery;
            $this->searchResultsMapper = $searchResultsMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var SearchModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();

            $results = $this->searchQuery->execute(
                $model->getQuery(),
                $model->getType(),
                $model->getAuthUserId(),
                $limit,
                $page
            );

            $model->setData(new Pagination(
                $limit,
                $page,
                $results['hits']['total'],
                $this->searchResultsMapper->map($results)
            ));
        }
    }
}
