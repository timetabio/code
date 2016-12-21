<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feeds
{
    use Timetabio\API\Services\PeopleService;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;

    class FetchPersonQuery
    {
        /**
         * @var PeopleService
         */
        private $peopleService;

        public function __construct(PeopleService $peopleService)
        {
            $this->peopleService = $peopleService;
        }

        public function execute(FeedId $feedId, UserId $userId)
        {
            return $this->peopleService->getPerson($feedId, $userId);
        }
    }
}
