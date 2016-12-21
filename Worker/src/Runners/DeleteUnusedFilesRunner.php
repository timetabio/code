<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
