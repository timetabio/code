<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Mappers
{
    use Timetabio\Library\Mappers\DocumentMapper;

    class FeedUserMapper
    {
        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(DocumentMapper $documentMapper)
        {
            $this->documentMapper = $documentMapper;
        }

        public function map(array $user): array
        {
            $mapped = $this->documentMapper->map($user);

            if (isset($mapped['user_id'])) {
                $mapped['user']['id'] = $mapped['user_id'];
                unset($mapped['user_id']);
            }

            if (isset($mapped['name'])) {
                $mapped['user']['name'] = $mapped['name'];
                unset($mapped['name']);
            }

            if (isset($mapped['username'])) {
                $mapped['user']['username'] = $mapped['username'];
                unset($mapped['username']);
            }

            unset($mapped['feed_id']);

            return $mapped;
        }
    }
}
