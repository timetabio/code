<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\BetaRequest
{
    use Timetabio\API\Services\BetaRequestService;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class CreateBetaRequestCommand
    {
        /**
         * @var BetaRequestService
         */
        private $betaRequestService;

        public function __construct(BetaRequestService $betaRequestService)
        {
            $this->betaRequestService = $betaRequestService;
        }

        public function execute(EmailAddress $email): array
        {
            return $this->betaRequestService->createBetaRequest($email);
        }
    }
}
