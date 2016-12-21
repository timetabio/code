<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Indexers
{
    use Timetabio\Framework\Backends\ElasticBackend;

    class PostIndexer implements Indexer
    {
        /**
         * @var ElasticBackend
         */
        private $elasticBackend;

        public function __construct(ElasticBackend $elasticBackend)
        {
            $this->elasticBackend = $elasticBackend;
        }

        public function indexDocument(string $id, array $document): void
        {
            $feedId = $document['feed']['id'];
            $document['_feed_id'] = $feedId;

            $this->elasticBackend->indexDocument('post', $id, $document);
        }

        public function deleteDocument(string $id): void
        {
            $this->elasticBackend->deleteDocument('post', $id);
        }
    }
}
