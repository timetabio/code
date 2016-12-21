<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands
{

    use Timetabio\API\Services\CollectionService;
    use Timetabio\API\ValueObjects\CollectionId;

    class UpdateCollectionCommand
    {
        /**
         * @var CollectionService
         */
        private $collectionService;

        public function __construct(CollectionService $collectionService)
        {
            $this->collectionService = $collectionService;
        }

        public function execute(CollectionId $collectionId, array $updates)
        {
            $this->collectionService->updateCollection($collectionId, $updates);
        }
    }
}
