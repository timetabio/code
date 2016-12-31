<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\BetaRequest
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\BetaRequestService;
    use Timetabio\Framework\ValueObjects\EmailAddress;
    use Timetabio\Library\Tasks\SendBetaInvitationTask;

    class CreateBetaRequestCommand
    {
        /**
         * @var BetaRequestService
         */
        private $betaRequestService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(BetaRequestService $betaRequestService, DataStoreWriter $dataStoreWriter)
        {
            $this->betaRequestService = $betaRequestService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(EmailAddress $email): array
        {
            $request = $this->betaRequestService->createBetaRequest($email);

            $this->dataStoreWriter->queueTask(new SendBetaInvitationTask($request['id']));

            return $request;
        }
    }
}
