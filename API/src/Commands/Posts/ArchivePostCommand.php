<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Posts
{
    use Timetabio\API\Services\PostService;
    use Timetabio\Framework\Backends\ElasticBackend;
    use Timetabio\Framework\ValueObjects\StringDateTime;

    class ArchivePostCommand
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var ElasticBackend
         */
        private $elasticBackend;

        public function __construct(PostService $postService, ElasticBackend $elasticBackend)
        {
            $this->postService = $postService;
            $this->elasticBackend = $elasticBackend;
        }

        public function execute(string $postId): string
        {
            $archived = $this->postService->archivePost($postId);

            $this->elasticBackend->updateDocument('post', $postId, [
                'archived' => (new StringDateTime($archived))->getTimestamp()
            ]);

            return $archived;
        }
    }
}
