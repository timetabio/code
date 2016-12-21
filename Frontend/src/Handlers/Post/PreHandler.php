<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
