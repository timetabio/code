<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\API\Services\FeedService;

    class FetchVanityByNameQuery
    {
        /**
         * @var FeedService
         */
        private $feedService;

        public function __construct(FeedService $feedService)
        {
            $this->feedService = $feedService;
        }

        public function execute(string $name)
        {
            return $this->feedService->getVanityByName($name);
        }
    }
}
