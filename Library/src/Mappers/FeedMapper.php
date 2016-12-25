<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Mappers
{
    class FeedMapper
    {
        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(DocumentMapper $documentMapper)
        {
            $this->documentMapper = $documentMapper;
        }

        public function map(array $feed): array
        {
            $mapped = $this->documentMapper->map($feed);

            if (isset($mapped['has_added'])) {
                $mapped['user']['has_added'] = $mapped['has_added'];
                unset($mapped['has_added']);
            }

            if (isset($mapped['owner_id'])) {
                $mapped['owner']['id'] = $mapped['owner_id'];
                unset($mapped['owner_id']);
            }

            if (isset($mapped['owner_username'])) {
                $mapped['owner']['username'] = $mapped['owner_username'];
                unset($mapped['owner_username']);
            }

            if (isset($mapped['owner_name'])) {
                $mapped['owner']['name'] = $mapped['owner_name'];
            }

            if (isset($mapped['vanity']) && $mapped['vanity'] === '') {
                unset($mapped['vanity']);
            }

            unset($mapped['owner_name']);

            return $mapped;
        }
    }
}
