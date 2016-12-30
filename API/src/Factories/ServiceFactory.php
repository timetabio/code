<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ServiceFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createUserService(): \Timetabio\API\Services\UserService
        {
            return new \Timetabio\API\Services\UserService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createCollectionService(): \Timetabio\API\Services\CollectionService
        {
            return new \Timetabio\API\Services\CollectionService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createFeedService(): \Timetabio\API\Services\FeedService
        {
            return new \Timetabio\API\Services\FeedService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createFollowerService(): \Timetabio\API\Services\FollowerService
        {
            return new \Timetabio\API\Services\FollowerService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createPeopleService(): \Timetabio\API\Services\PeopleService
        {
            return new \Timetabio\API\Services\PeopleService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createPostService(): \Timetabio\API\Services\PostService
        {
            return new \Timetabio\API\Services\PostService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createFileService(): \Timetabio\API\Services\FileService
        {
            return new \Timetabio\API\Services\FileService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createBetaRequestService(): \Timetabio\API\Services\BetaRequestService
        {
            return new \Timetabio\API\Services\BetaRequestService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }
    }
}
