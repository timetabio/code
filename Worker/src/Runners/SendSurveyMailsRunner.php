<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\SendSurveyMailsTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\BetaRequestService;

    class SendSurveyMailsRunner implements RunnerInterface
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

        public function run(TaskInterface $task)
        {
            if (!$task instanceof SendSurveyMailsTask) {
                return;
            }

            foreach ($this->betaRequestService->getBetaRequestIds() as $id) {
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\SendSurveyMailTask($id));
            }
        }
    }
}
