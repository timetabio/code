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
    use Timetabio\Framework\Backends\AwsRestBackend;
    use Timetabio\Library\Builders\UriBuilder;
    use Timetabio\Library\Tasks\DeleteUnusedFilesTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Services\FileService;

    class DeleteUnusedFilesRunner implements RunnerInterface
    {
        /**
         * @var AwsRestBackend
         */
        private $awsRestBackend;

        /**
         * @var FileService
         */
        private $fileService;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(AwsRestBackend $awsRestBackend, FileService $fileService, UriBuilder $uriBuilder)
        {
            $this->awsRestBackend = $awsRestBackend;
            $this->fileService = $fileService;
            $this->uriBuilder = $uriBuilder;
        }

        public function run(TaskInterface $task)
        {
            if (!($task instanceof DeleteUnusedFilesTask)) {
                return;
            }

            $files = $this->fileService->getUnusedFiles(20);

            foreach ($files as $file) {
                $uri = $this->uriBuilder->buildFileUri($file['public_id'], $file['name']);

                echo 'Deleting file ' . $uri . PHP_EOL;

                $this->awsRestBackend->deleteObject($uri);
                $this->fileService->deleteFile($file['id']);
            }
        }
    }
}
