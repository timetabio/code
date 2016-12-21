<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\Library\Services\FeedInvitationService;

    class DeleteInvitationCommand
    {
        /**
         * @var FeedInvitationService
         */
        private $invitationService;

        public function __construct(FeedInvitationService $invitationService)
        {
            $this->invitationService = $invitationService;
        }

        public function execute(string $feedId, string $userId)
        {
            $this->invitationService->deleteInvitation($feedId, $userId);
        }
    }
}
