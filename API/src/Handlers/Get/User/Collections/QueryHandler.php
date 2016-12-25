<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\User\Collections
{
    use Timetabio\API\Models\ListModel;
    use Timetabio\API\Queries\User\FetchUserCollectionsQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserCollectionsQuery
         */
        private $fetchUserCollectionsQuery;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(
            FetchUserCollectionsQuery $fetchUserCollectionQuery,
            DocumentMapper $documentMapper
        )
        {
            $this->fetchUserCollectionsQuery = $fetchUserCollectionQuery;
            $this->documentMapper = $documentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();

            $collections = $this->fetchUserCollectionsQuery->execute($model->getAuthUserId(), $limit, $page);

            $mapped = [];

            foreach ($collections as $collection) {
                $mapped[] = $this->documentMapper->map($collection);
            }

            $model->setData([
                'pagination' => [
                    'limit' => $limit,
                    'page' => $page
                ],
                'collections' => $mapped
            ]);

            return $mapped;

        }
    }
}
