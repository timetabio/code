<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\Library\Services\FeedInvitationService;

    class InvitationExistsQuery
    {
        /**
         * @var FeedInvitationService
         */
        private $feedInvitationService;

        public function __construct(FeedInvitationService $feedInvitationService)
        {
            $this->feedInvitationService = $feedInvitationService;
        }

        public function execute(string $feedId, string $userId): bool
        {
            return $this->feedInvitationService->hasInvitation($feedId, $userId);
        }
    }
}
