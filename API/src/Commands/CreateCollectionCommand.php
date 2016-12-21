<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands
{
    use Timetabio\API\Services\CollectionService;
    use Timetabio\API\ValueObjects\CollectionName;
    use Timetabio\API\ValueObjects\UserId;

    class CreateCollectionCommand
    {
        /**
         * @var CollectionService
         */
        private $collectionService;

        public function __construct(CollectionService $collectionService)
        {
            $this->collectionService = $collectionService;
        }

        public function execute(CollectionName $collectionName, UserId $userId): array
        {
            return $this->collectionService->createCollection($collectionName, $userId);
        }
    }
}
