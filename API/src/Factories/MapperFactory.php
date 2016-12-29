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

    class MapperFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createFeedUserMapper(): \Timetabio\API\Mappers\FeedUserMapper
        {
            return new \Timetabio\API\Mappers\FeedUserMapper(
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createPostAttachmentMapper(): \Timetabio\API\Mappers\PostAttachmentMapper
        {
            return new \Timetabio\API\Mappers\PostAttachmentMapper(
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createSearchResultsMapper(): \Timetabio\API\Mappers\SearchResultsMapper
        {
            return new \Timetabio\API\Mappers\SearchResultsMapper;
        }

        public function createResultsMapper(): \Timetabio\API\Mappers\ResultsMapper
        {
            return new \Timetabio\API\Mappers\ResultsMapper;
        }
    }
}
