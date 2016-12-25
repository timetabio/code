<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
