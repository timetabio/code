<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class IndexerFactory extends AbstractChildFactory
    {
        public function createFeedIndexer(): \Timetabio\Library\Indexers\FeedIndexer
        {
            return new \Timetabio\Library\Indexers\FeedIndexer(
                $this->getMasterFactory()->createElasticBackend()
            );
        }

        public function createPostIndexer(): \Timetabio\Library\Indexers\PostIndexer
        {
            return new \Timetabio\Library\Indexers\PostIndexer(
                $this->getMasterFactory()->createElasticBackend()
            );
        }

        public function createUserIndexer(): \Timetabio\Library\Indexers\UserIndexer
        {
            return new \Timetabio\Library\Indexers\UserIndexer(
                $this->getMasterFactory()->createElasticBackend()
            );
        }
    }
}
