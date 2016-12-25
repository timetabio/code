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
    class ResultsMapper
    {
        public function map(array $results): array
        {
            $mapped = [];

            foreach($results['hits']['hits'] as $result) {
                $mapped[] = $this->mapResult($result);
            }

            return $mapped;
        }

        protected function mapResult(array $result): array
        {
            unset($result['_source']['_feed_id']);

            return $result['_source'];
        }
    }
}
