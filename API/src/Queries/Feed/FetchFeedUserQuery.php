<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\API\Services\PeopleService;

    class FetchFeedUserQuery
    {
        /**
         * @var PeopleService
         */
        private $peopleService;

        public function __construct(PeopleService $peopleService)
        {
            $this->peopleService = $peopleService;
        }

        public function execute(string $feedId, string $userId)
        {
            return $this->peopleService->getPerson($feedId, $userId);
        }
    }
}
