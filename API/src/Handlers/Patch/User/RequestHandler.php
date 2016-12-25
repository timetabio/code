<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\User
{
    use Timetabio\API\Models\User\UpdateUserModel;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PatchRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PatchRequest $request */
            /** @var UpdateUserModel $model */

            if ($request->hasParam('name')) {
                $model->addUpdate('name', trim($request->getParam('name')));
            }

            if ($request->hasParam('username')) {
                $model->addUpdate('username', $request->getParam('username'));
            }
        }
    }
}
