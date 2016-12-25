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
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var CreateModel $model */

            if (!$request->hasParam('email')) {
                throw new BadRequest('missing parameter \'email\'', 'missing_parameter');
            }

            try {
                $model->setEmail(new EmailAddress($request->getParam('email')));
            } catch (\Exception $exception) {
                throw new BadRequest('invalid email address', 'invalid_email');
            }
        }
    }
}
