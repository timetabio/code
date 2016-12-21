<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feeds
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PeopleService;

    class DeleteFeedPersonCommand
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

        public function execute(string $feedId, string $userId)
        {
            $this->peopleService->deletePerson($feedId, $userId);

            $this->dataStoreWriter->removeFeedAccess($feedId, $userId);

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexUserTask($userId));
        }
    }
}
