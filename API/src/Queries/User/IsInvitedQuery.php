<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\BetaRequestService;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class IsInvitedQuery
    {
        /**
         * @var BetaRequestService
         */
        private $betaRequestService;

        public function __construct(BetaRequestService $betaRequestService)
        {
            $this->betaRequestService = $betaRequestService;
        }

        public function execute(EmailAddress $email): bool
        {
            return $this->betaRequestService->isApproved($email);
        }
    }
}
