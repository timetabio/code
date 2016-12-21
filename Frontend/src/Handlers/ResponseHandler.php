<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
