<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Indexers
{
    use Timetabio\Framework\Backends\ElasticBackend;

    class PostIndexer implements Indexer
    {
        /**
         * @var ElasticBackend
         */
        private $elasticBackend;

        public function __construct(ElasticBackend $elasticBackend)
        {
            $this->elasticBackend = $elasticBackend;
        }

        public function indexDocument(string $id, array $document): void
        {
            $feedId = $document['feed']['id'];
            $document['_feed_id'] = $feedId;

            $this->elasticBackend->indexDocument('post', $id, $document);
        }

        public function deleteDocument(string $id): void
        {
            $this->elasticBackend->deleteDocument('post', $id);
        }
    }
}
