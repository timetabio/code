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
    use Timetabio\API\Builders\UriBuilder;

    class PostAttachmentMapper
    {
        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(UriBuilder $uriBuilder)
        {
            $this->uriBuilder = $uriBuilder;
        }

        public function map(array $attachment): array
        {
            $mapped = [];

            if (isset($attachment['filename'])) {
                $mapped['filename'] = $attachment['filename'];
            }

            if (isset($attachment['mime_type'])) {
                $mapped['mime_type'] = $attachment['mime_type'];
            }

            if (isset($attachment['public_id']) && isset($attachment['filename'])) {
                $mapped['url'] = $this->uriBuilder->buildFileUri($attachment['public_id'], $attachment['filename']);
            }

            return $mapped;
        }
    }
}
