<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\Library\Services\FeedInvitationService;
    use Timetabio\Library\UserRoles\UserRole;

    class UpdateInvitationCommand
    {
        /**
         * @var FeedInvitationService
         */
        private $invitationService;

        public function __construct(FeedInvitationService $invitationService)
        {
            $this->invitationService = $invitationService;
        }

        public function execute(string $feedId, string $userId, UserRole $role)
        {
            $this->invitationService->updateInvitation($feedId, $userId, $role);
        }
    }
}
