<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\File
{
    use Timetabio\API\Services\FileService;

    class FetchFileByPublicIdQuery
    {
        /**
         * @var FileService
         */
        private $fileService;

        public function __construct(FileService $fileService)
        {
            $this->fileService = $fileService;
        }

        public function execute(string $path)
        {
            return $this->fileService->getByPublicId($path);
        }
    }
}
