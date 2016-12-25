<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\Profile
{
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Profile\ProfileModel;
    use Timetabio\API\Queries\Profile\FetchProfileQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchProfileQuery
         */
        private $fetchProfileQuery;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(FetchProfileQuery $fetchProfileQuery, DocumentMapper $documentMapper)
        {
            $this->fetchProfileQuery = $fetchProfileQuery;
            $this->documentMapper = $documentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ProfileModel $model */

            $profile = $this->fetchProfileQuery->execute($model->getUsername());

            if ($profile === null) {
                throw new NotFound('profile not found', 'not_found');
            }

            $model->setData($this->documentMapper->map($profile));
        }
    }
}
