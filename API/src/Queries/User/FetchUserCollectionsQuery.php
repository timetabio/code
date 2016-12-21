<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\CollectionService;
    use Timetabio\API\ValueObjects\UserId;

    class FetchUserCollectionsQuery
    {
        /**
         * @var CollectionService
         */
        private $collectionService;

        public function __construct(CollectionService $collectionService)
        {
            $this->collectionService = $collectionService;
        }

        public function execute(UserId $userId, int $limit, int $page = 1): array
        {
            return $this->collectionService->getCollectionsByUser($userId, $limit, $page);
        }
    }
}
