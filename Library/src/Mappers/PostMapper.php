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
    use Timetabio\Framework\ValueObjects\StringDateTime;

    class PostMapper
    {
        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(DocumentMapper $documentMapper)
        {
            $this->documentMapper = $documentMapper;
        }

        public function map(array $post): array
        {
            $mapped = $this->documentMapper->map($post);

            if (isset($mapped['parsed_body'])) {
                $mapped['parsed_body'] = json_decode($mapped['parsed_body'], true);
            }

            if (isset($mapped['feed_id'])) {
                $mapped['feed']['id'] = $mapped['feed_id'];
                unset($mapped['feed_id']);
            }

            if (isset($mapped['feed_name'])) {
                $mapped['feed']['name'] = $mapped['feed_name'];
                unset($mapped['feed_name']);
            }

            if (isset($mapped['author_id'])) {
                $mapped['author']['id'] = $mapped['author_id'];
                unset($mapped['author_id']);
            }

            if (isset($mapped['author_username'])) {
                $mapped['author']['username'] = $mapped['author_username'];
                unset($mapped['author_username']);
            }

            if (isset($mapped['author_name'])) {
                $mapped['author']['name'] = $mapped['author_name'];
                unset($mapped['author_name']);
            }

            if (isset($mapped['timestamp']) && $mapped['timestamp'] !== null) {
                $mapped['timestamp'] = (new StringDateTime($mapped['timestamp']))->getTimestamp();
            }

            if (isset($mapped['user_id'])) {
                unset($mapped['user_id']);
            }

            return $mapped;
        }
    }
}
