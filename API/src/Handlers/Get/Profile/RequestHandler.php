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
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Profile\ProfileModel;
    use Timetabio\API\ValueObjects\Username;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var ProfileModel $model */

            $path = $request->getUri()->getExplodedPath();

            try {
                $username = new Username($path[2]);
            } catch (\Exception $exception) {
                throw new BadRequest('invalid username', 'invalid_username');
            }

            $model->setUsername($username);
        }
    }
}
