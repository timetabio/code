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

    class MapperFactory extends AbstractChildFactory
    {
        public function createDocumentMapper(): \Timetabio\Library\Mappers\DocumentMapper
        {
            return new \Timetabio\Library\Mappers\DocumentMapper;
        }

        public function createPostMapper():  \Timetabio\Library\Mappers\PostMapper
        {
            return new \Timetabio\Library\Mappers\PostMapper(
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createFeedMapper():  \Timetabio\Library\Mappers\FeedMapper
        {
            return new \Timetabio\Library\Mappers\FeedMapper(
                $this->getMasterFactory()->createDocumentMapper()
            );
        }
    }
}
