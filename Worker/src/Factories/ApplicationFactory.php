<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ApplicationFactory extends AbstractChildFactory
    {
        public function createWorker(): \Timetabio\Worker\Worker
        {
            return new \Timetabio\Worker\Worker(
                $this->getMasterFactory()->createRedisBackend(),
                $this->getMasterFactory()->createRunnerLocator()
            );
        }

        public function createStaticPageBuilder(): \Timetabio\Worker\Builders\StaticPageBuilder
        {
            return new \Timetabio\Worker\Builders\StaticPageBuilder(
                $this->getMasterFactory()->createFileBackend(),
                $this->getMasterFactory()->createStatusCodeLocator(),
                $this->getMasterFactory()->createStaticPageRenderer(),
                $this->getMasterFactory()->createGettext()
            );
        }

        public function createDataStoreWriter(): \Timetabio\Worker\DataStore\DataStoreWriter
        {
            return new \Timetabio\Worker\DataStore\DataStoreWriter(
                $this->getMasterFactory()->createRedisBackend()
            );
        }

        public function createDataStoreReader(): \Timetabio\Worker\DataStore\DataStoreReader
        {
            return new \Timetabio\Worker\DataStore\DataStoreReader(
                $this->getMasterFactory()->createRedisBackend()
            );
        }

        public function createFileService(): \Timetabio\Worker\Services\FileService
        {
            return new \Timetabio\Worker\Services\FileService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createPostService(): \Timetabio\Worker\Services\PostService
        {
            return new \Timetabio\Worker\Services\PostService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createUserService(): \Timetabio\Worker\Services\UserService
        {
            return new \Timetabio\Worker\Services\UserService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createFeedService(): \Timetabio\Worker\Services\FeedService
        {
            return new \Timetabio\Worker\Services\FeedService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }
    }
}
