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
    use Timetabio\Framework\Handlers\ResponseHandlerInterface;
    use Timetabio\Framework\Http\Response\ResponseInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Session\Session;

    class ResponseHandler implements ResponseHandlerInterface
    {
        /**
         * @var Session
         */
        private $session;

        public function __construct(Session $session)
        {
            $this->session = $session;
        }

        public function execute(ResponseInterface $response, AbstractModel $model)
        {
            /** @var \Timetabio\Frontend\Models\FrontendModel $model */

            $response->setCookie($this->session->getCookie());

            $this->setStatusCode($response, $model);
        }

        private function setStatusCode(ResponseInterface $response, \Timetabio\Frontend\Models\FrontendModel $model)
        {
            if (!$model->hasStatusCode()) {
                return;
            }

            $response->setStatusCode($model->getStatusCode());
        }
    }
}
