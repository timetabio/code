<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\InitialTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;

    class InitialRunner implements RunnerInterface
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!($task instanceof InitialTask)) {
                return;
            }

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\BuildStaticPagesTask);
            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\DeleteUnusedFilesTask);
        }
    }
}
