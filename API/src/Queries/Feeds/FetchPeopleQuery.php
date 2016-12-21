<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feeds
{
    use Timetabio\API\Services\PeopleService;

    class FetchPeopleQuery
    {
        /**
         * @var PeopleService
         */
        private $peopleService;

        public function __construct(PeopleService $peopleService)
        {
            $this->peopleService = $peopleService;
        }

        public function execute(string $feedId)
        {
            return $this->peopleService->getPeople($feedId);
        }
    }
}
