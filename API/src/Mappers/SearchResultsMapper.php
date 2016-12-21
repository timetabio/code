<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Mappers
{
    class SearchResultsMapper extends ResultsMapper
    {
        protected function mapResult(array $result): array
        {
            unset($result['_source']['_feed_id']);

            $mapped = [
                'type' => $result['_type'],
                'data' => $result['_source']
            ];

            return $mapped;
        }
    }
}
