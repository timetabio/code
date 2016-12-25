<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Verify\Resend
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Verify\ResendModel;
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
            /** @var ResendModel $model */

            if (!$request->hasParam('email')) {
                throw new BadRequest('required parameter \'email\' missing', 'parameter_missing');
            }

            try {
                $email = new EmailAddress($request->getParam('email'));
            } catch (\Exception $exception) {
                throw new BadRequest('invalid email', 'invalid_email');
            }

            $model->setEmail($email);
        }
    }
}
