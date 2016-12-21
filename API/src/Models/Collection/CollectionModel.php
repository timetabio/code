<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Collection
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\CollectionId;

    class CollectionModel extends APIModel
    {
        /**
         * @var CollectionId
         */
        private $collectionId;

        public function getCollectionId(): CollectionId
        {
            return $this->collectionId;
        }

        public function setCollectionId(CollectionId $collectionId)
        {
            $this->collectionId = $collectionId;
        }
    }
}
