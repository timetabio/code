<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feed\Invitations
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\DataObjects\FeedInvitation;
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
            /** @var \Timetabio\Framework\Http\Request\PostRequest $request */
            /** @var \Timetabio\API\Models\Feed\Invitation\CreateModel $model */

            $parts = $request->getUri()->getExplodedPath();

            if (!$request->hasParam('username')) {
                throw new BadRequest('required parameter \'username\' is missing', 'parameter_missing');
            }

            if (!$request->hasParam('role')) {
                throw new BadRequest('required parameter \'role\' is missing', 'parameter_missing');
            }

            $username = $request->getParam('username');

            try {
                $role = $this->userRoleLocator->locate($request->getParam('role'));
            } catch (\Exception $exception) {
                throw new BadRequest('invalid role', 'invalid_role');
            }

            $model->setInvitationFeedId($parts[2]);
            $model->setInvitationUsername($username);
            $model->setInvitationUserRole($role);
        }
    }
}
