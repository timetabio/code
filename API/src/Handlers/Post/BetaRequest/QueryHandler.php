<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\BetaRequest
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\BetaRequest\CreateModel;
    use Timetabio\API\Queries\BetaRequest\FetchBetaRequestByEmailQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchBetaRequestByEmailQuery
         */
        private $fetchBetaRequestByEmailQuery;

        public function __construct(FetchBetaRequestByEmailQuery $fetchBetaRequestByEmailQuery)
        {
            $this->fetchBetaRequestByEmailQuery = $fetchBetaRequestByEmailQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            if ($this->fetchBetaRequestByEmailQuery->execute($model->getEmail())) {
                throw new BadRequest('email already added', 'email_already_added');
            }
        }
    }
}
