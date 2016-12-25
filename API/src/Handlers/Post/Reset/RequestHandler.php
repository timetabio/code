<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Reset
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\ResetPasswordModel;
    use Timetabio\API\ValueObjects\Password;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var ResetPasswordModel $model */

            if (!$request->hasParam('token')) {
                throw new BadRequest('missing parameter \'token\'', 'missing_parameter');
            }

            if (!$request->hasParam('password')) {
                throw new BadRequest('missing parameter \'password\'', 'missing_parameter');
            }

            try {
                $password = new Password($request->getParam('password'));
            } catch(\Exception $exception) {
                throw new BadRequest('password must be between 8 and 72 characters', 'invalid_password');
            }

            $model->setNewPassword($password);
            $model->setToken($request->getParam('token'));
        }
    }
}
