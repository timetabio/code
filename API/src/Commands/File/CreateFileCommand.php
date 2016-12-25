<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
