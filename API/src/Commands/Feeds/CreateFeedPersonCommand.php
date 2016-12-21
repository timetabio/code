<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feeds
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PeopleService;

    class CreateFeedPersonCommand
    {
        /**
         * @var PeopleService
         */
        private $peopleService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PeopleService $peopleService, DataStoreWriter $dataStoreWriter)
        {
            $this->peopleService = $peopleService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $feedId, string $userId, bool $post)
        {
            $this->peopleService->createPerson($feedId, $userId, $post);
            $this->dataStoreWriter->addFeedReadAccess($feedId, $userId);

            if ($post) {
                $this->dataStoreWriter->addFeedPostAccess($feedId, $userId);
            }
        }
    }
}
