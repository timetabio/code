<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\Library\Services\FeedInvitationService;

    class FetchInvitationQuery
    {
        /**
         * @var FeedInvitationService
         */
        private $feedInvitationService;

        public function __construct(FeedInvitationService $feedInvitationService)
        {
            $this->feedInvitationService = $feedInvitationService;
        }

        public function execute(string $feedId, string $userId)
        {
            return $this->feedInvitationService->getInvitation($feedId, $userId);
        }
    }
}
