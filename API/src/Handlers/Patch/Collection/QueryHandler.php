<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Collection
{

    use Timetabio\API\Access\AccessControl\CollectionAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Collection\UpdateModel;
    use Timetabio\API\Queries\FetchCollectionQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchCollectionQuery
         */
        private $fetchCollectionQuery;

        /**
         * @var CollectionAccessControl
         */
        private $accessControl;

        public function __construct(FetchCollectionQuery $fetchCollectionQuery, CollectionAccessControl $collectionAccessControl)
        {
            $this->fetchCollectionQuery = $fetchCollectionQuery;
            $this->accessControl = $collectionAccessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $token = $model->getAccessToken();

            $collection = $this->fetchCollectionQuery->execute($model->getCollectionId());

            if ($collection === null || !$this->accessControl->hasWriteAccess($token, $collection)) {
                throw new NotFound('collection not found', 'not_found');
            }
        }
    }
}
