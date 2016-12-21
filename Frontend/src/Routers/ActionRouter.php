<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Exceptions\RouterException;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;

    class ActionRouter implements RouterInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        public function __construct(MasterFactoryInterface $factory)
        {
            $this->factory = $factory;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            switch ($request->getUri()->getPath()) {
                case '/action/register':
                    return $this->factory->createRegisterController();
                case '/action/login':
                    return $this->factory->createLoginController();
                case '/action/resend-verification':
                    return $this->factory->createResendVerificationController();
                case '/action/beta-request':
                    return $this->factory->createCreateBetaRequestController();
            }

            throw new RouterException;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\PostRequest;
        }
    }
}
