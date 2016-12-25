<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post
{
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Session\Session;

    class PreHandler implements PreHandlerInterface
    {
        /**
         * @var Session
         */
        private $session;

        public function __construct(Session $session)
        {
            $this->session = $session;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */

            if (!$this->checkCrfsToken($request)) {
                throw new BadRequest('invalid crfs token');
            }
        }

        private function checkCrfsToken(PostRequest $request): bool
        {
            if (!$request->hasParam('token')) {
                return false;
            }

            $token = $request->getParam('token');

            return $token === (string) $this->session->getCrfsToken();
        }
    }
}
