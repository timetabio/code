<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\DataStore
{
    use Timetabio\Library\DataStore\AbstractDataStoreReader;

    class DataStoreReader extends AbstractDataStoreReader
    {
        public function getPostText(string $postId): string
        {
            return $this->getDataStore()->get('post_text:' . $postId);
        }
    }
}
