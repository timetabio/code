<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
