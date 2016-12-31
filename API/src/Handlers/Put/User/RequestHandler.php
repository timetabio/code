<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\User
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\User\UpdateUserPasswordModel;
    use Timetabio\API\ValueObjects\Password;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PutRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PutRequest $request */
            /** @var UpdateUserPasswordModel $model */

            if (!$request->hasParam('old_password')) {
                throw new BadRequest('missing parameter \'old_password\'', 'missing_parameter');
            }

            if (!$request->hasParam('password')) {
                throw new BadRequest('missing parameter \'password\'', 'missing_parameter');
            }

            try {
                $password = new Password($request->getParam('password'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_password');
            }

            $model->setOldPassword($request->getParam('old_password'));
            $model->setNewPassword($password);
        }
    }
}
