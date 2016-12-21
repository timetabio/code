<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries
{

    use Timetabio\API\Services\CollectionService;
    use Timetabio\API\ValueObjects\CollectionId;

    class FetchCollectionQuery
    {
        /**
         * @var CollectionService
         */
        private $collectionService;

        public function __construct(CollectionService $collectionService)
        {
            $this->collectionService = $collectionService;
        }

        public function execute(CollectionId $id)
        {
            return $this->collectionService->getCollectionById($id);
        }
    }
}
