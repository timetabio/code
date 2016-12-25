<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Auth
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\AuthModel;
    use Timetabio\API\ValueObjects\StringBoolean;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var AuthModel $model */

            if (!$request->hasParam('user')) {
                throw new BadRequest('required parameter \'user\' is missing', 'parameter_missing');
            }

            if (!$request->hasParam('password')) {
                throw new BadRequest('required parameter \'password\' is missing', 'parameter_missing');
            }

            $user = $request->getParam('user');
            $password = $request->getParam('password');
            $scopes = '*';
            $autoRenew = false;

            if ($request->hasParam('scopes')) {
                $scopes = $request->getParam('scopes');
            }

            if ($request->hasParam('auto_renew')) {
                try {
                    $autoRenew = (new StringBoolean($request->getParam('auto_renew')))->getValue();
                } catch (\Exception $exception) {
                    throw new BadRequest('auto_renew must either be true or false', 'invalid_auto_renew');
                }
            }

            try {
                $accessType = $this->getAccessType($scopes);
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_scope');
            }

            $model->setUser($user);
            $model->setPassword($password);
            $model->setAccessType($accessType);
            $model->setAutoRenew($autoRenew);
        }

        private function getAccessType(string $scopes): AccessTypeInterface
        {
            if ($scopes === '*') {
                return new \Timetabio\API\Access\AccessTypes\FullAccess;
            }

            return new \Timetabio\API\Access\AccessTypes\ScopedAccess(explode(',', $scopes));
        }
    }
}
