<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\Collection
{
    use Timetabio\API\Access\AccessControl\CollectionAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Collection\CollectionModel;
    use Timetabio\API\Queries\FetchCollectionQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchCollectionQuery
         */
        private $fetchCollectionQuery;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        /**
         * @var CollectionAccessControl
         */
        private $accessControl;

        public function __construct(
            FetchCollectionQuery $fetchCollectionQuery,
            DocumentMapper $documentMapper,
            CollectionAccessControl $accessControl
        )
        {
            $this->fetchCollectionQuery = $fetchCollectionQuery;
            $this->documentMapper = $documentMapper;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CollectionModel $model */

            $collection = $this->fetchCollectionQuery->execute($model->getCollectionId());

            if ($collection === null || !$this->accessControl->hasReadAccess($model->getAccessToken(), $collection)) {
                throw new NotFound('collection not found', 'not_found');
            }

            $model->setData($this->documentMapper->map($collection));
        }
    }
}
