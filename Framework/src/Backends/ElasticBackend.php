<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Backends
{
    use Elasticsearch\Client;

    class ElasticBackend
    {
        /**
         * @var Client
         */
        private $client;

        /**
         * @var string
         */
        private $index;

        public function __construct(Client $client, string $index)
        {
            $this->client = $client;
            $this->index = $index;
        }

        public function indexDocument(string $type, string $id, array $document): array
        {
            return $this->client->index([
                'index' => $this->index,
                'type' => $type,
                'id' => $id,
                'body' => $document
            ]);
        }

        public function indexRoutedDocument(string $type, string $id, string $routing, array $document): array
        {
            return $this->client->index([
                'index' => $this->index,
                'type' => $type,
                'id' => $id,
                'routing' => $routing,
                'body' => $document
            ]);
        }

        public function indexChildDocument(string $type, string $id, string $parent, array $document): array
        {
            return $this->client->index([
                'index' => $this->index,
                'type' => $type,
                'id' => $id,
                'parent' => $parent,
                'body' => $document
            ]);
        }

        public function deleteDocument(string $type, string $id): array
        {
            return $this->client->delete([
                'index' => $this->index,
                'type' => $type,
                'id' => $id
            ]);
        }

        public function search(string $type, int $from, int $size, array $body): array
        {
            return $this->client->search([
                'index' => $this->index,
                'type' => $type,
                'from' => $from,
                'size' => $size,
                'body' => $body
            ]);
        }
    }
}
