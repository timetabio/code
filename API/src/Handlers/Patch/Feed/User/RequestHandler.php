<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Feed\User
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Feed\User\UpdateModel;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Locators\UserRoleLocator;

    class RequestHandler implements RequestHandlerInterface
    {
        /**
         * @var UserRoleLocator
         */
        private $userRoleLocator;

        public function __construct(UserRoleLocator $userRoleLocator)
        {
            $this->userRoleLocator = $userRoleLocator;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var UpdateModel $model */

            if (!$request->hasParam('role')) {
                throw new BadRequest('missing parameter \'role\'', 'missing_parameter');
            }

            try {
                $role = $this->userRoleLocator->locate($request->getParam('role'));
            } catch (\Exception $exception) {
                throw new BadRequest('invalid user role', 'invalid_role');
            }

            $model->setRole($role);
        }
    }
}
