<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\BetaRequest
{
    use Timetabio\API\Services\BetaRequestService;

    class FetchBetaRequestByEmailQuery
    {
        /**
         * @var BetaRequestService
         */
        private $betaRequestService;

        public function __construct(BetaRequestService $betaRequestService)
        {
            $this->betaRequestService = $betaRequestService;
        }

        public function execute(string $email)
        {
            return $this->betaRequestService->getBetaRequestByEmail($email);
        }
    }
}
