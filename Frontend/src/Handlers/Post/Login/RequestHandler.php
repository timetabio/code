<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Login
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Models\Action\LoginModel;
    use Timetabio\Frontend\ValueObjects\RedirectUri;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var LoginModel $model */

            try {
                $model->setLoginUser($request->getParam('user'));
                $model->setPassword($request->getParam('password'));
            } catch (\Exception $exception) {
                throw new BadRequest('missing fields');
            }

            $model->setNextUri($this->getNextUri($request));
        }

        private function getNextUri(PostRequest $request): RedirectUri
        {
            try {
                return new RedirectUri($request->getParam('next_uri'));
            } catch (\Exception $exception) {
                return new RedirectUri('/');
            }
        }
    }
}
