<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Indexers
{
    interface Indexer
    {
        public function indexDocument(string $id, array $document): void;

        public function deleteDocument(string $id): void;
    }
}
