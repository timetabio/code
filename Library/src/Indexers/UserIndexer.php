<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Indexers
{
    use Timetabio\Framework\Backends\ElasticBackend;

    class UserIndexer implements Indexer
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
            $this->elasticBackend->indexDocument('user', $id, $document);
        }

        public function deleteDocument(string $id): void
        {
            $this->elasticBackend->deleteDocument('user', $id);
        }
    }
}
