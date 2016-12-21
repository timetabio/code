<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\File
{
    use Timetabio\API\Services\FileService;
    use Timetabio\API\ValueObjects\FeedFile;

    class CreateFileCommand
    {
        /**
         * @var FileService
         */
        private $fileService;

        public function __construct(FileService $fileService)
        {
            $this->fileService = $fileService;
        }

        public function execute(string $ownerId, FeedFile $file, string $mimeType): array
        {
            return $this->fileService->createFile($ownerId, $file->getPublicId(), $file->getFilename(), $mimeType);
        }
    }
}
