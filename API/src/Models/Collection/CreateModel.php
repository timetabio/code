<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Collection
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\CollectionName;

    class CreateModel extends APIModel
    {
        /**
         * @var CollectionName
         */
        private $collectionName;

        public function getCollectionName(): CollectionName
        {
            return $this->collectionName;
        }

        public function setCollectionName(CollectionName $collectionName)
        {
            $this->collectionName = $collectionName;
        }
    }
}
