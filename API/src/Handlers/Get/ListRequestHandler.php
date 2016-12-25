<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\ListModel;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class ListRequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var ListModel $model */
            $this->setLimit($request, $model);
            $this->setPage($request, $model);
        }

        private function setLimit(RequestInterface $request, ListModel $model)
        {
            try {
                $model->setLimit($request->getQueryParam('limit'));
            } catch (\Throwable $exception) {
            }

            if ($model->getLimit() < 1) {
                throw new BadRequest('limit must be above zero', 'invalid_limit');
            }
        }

        private function setPage(RequestInterface $request, ListModel $model)
        {
            try {
                $model->setPage($request->getQueryParam('page'));
            } catch (\Throwable $exception) {
            }

            if ($model->getPage() < 0) {
                throw new BadRequest('page must be a positive integer', 'invalid_page');
            }
        }
    }
}
