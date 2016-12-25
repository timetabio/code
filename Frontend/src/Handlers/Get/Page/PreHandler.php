<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\Page
{
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\FrontendModel;
    use Timetabio\Frontend\Models\PageModel;
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
            /** @var FrontendModel $model */

            $session = $this->session;

            $model->setCrfsToken($session->getCrfsToken());

            if ($session->hasUser()) {
                $model->setUser($session->getUser());
            }

            if ($request->isDnt() && $model instanceof PageModel) {
                $model->disableTracking();
            }
        }
    }
}
