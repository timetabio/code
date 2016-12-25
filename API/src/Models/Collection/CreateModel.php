<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
