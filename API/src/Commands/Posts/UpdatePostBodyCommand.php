<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Posts
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PostService;
    use Timetabio\API\ValueObjects\PostBody;
    use Timetabio\Framework\Backends\InkBackend;

    class UpdatePostBodyCommand
    {
        /**
         * @var InkBackend
         */
        private $inkBackend;

        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(InkBackend $inkBackend, PostService $postService, DataStoreWriter $dataStoreWriter)
        {
            $this->inkBackend = $inkBackend;
            $this->postService = $postService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $postId, PostBody $body): void
        {
            $inkResult = $this->inkBackend->process($body);

            $this->postService->setPostBody($postId, $body);

            $this->dataStoreWriter->setPostBody($postId, $inkResult->getBody());
            $this->dataStoreWriter->setPostText($postId, $inkResult->getPlainText());

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($postId));
        }
    }
}
