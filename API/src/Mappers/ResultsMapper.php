<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
