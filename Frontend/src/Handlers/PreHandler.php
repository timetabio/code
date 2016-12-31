<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers
{
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\FrontendModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Session\Session;
    use Timetabio\Frontend\ValueObjects\RedirectUri;

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
            $model->setUri($request->getUri());

            if ($session->hasUser()) {
                $model->setUser($session->getUser());
            }

            // TODO: move this to a `Page` specific `PreHandler`
            if ($request->isDnt() && $model instanceof PageModel) {
                $model->disableTracking();
            }

            // TODO: move this to a `Page` specific `PreHandler`
            if ($request->hasQueryParam('next') && $model instanceof PageModel) {
                $this->setNextUri($request, $model);
            }
        }

        private function setNextUri(RequestInterface $request, PageModel $model)
        {
            try {
                $model->setNextUri(new RedirectUri($request->getQueryParam('next')));
            } catch (\Exception $exception) {
            }
        }
    }
}
