<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
