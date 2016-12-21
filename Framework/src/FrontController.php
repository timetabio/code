<?php
// @codeCoverageIgnoreStart
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework
{
    use Timetabio\Framework\Bootstrap\AbstractBootstrapper;

    class FrontController
    {
        /**
         * @var AbstractBootstrapper
         */
        private $bootstrapper;

        public function __construct(AbstractBootstrapper $bootstrapper)
        {
            $this->bootstrapper = $bootstrapper;
        }

        public function run()
        {
            $request = $this->bootstrapper->getRequest();

            $this->bootstrapper->getRouter()
                ->route($request)
                ->processRequest($request)
                ->send();
        }
    }
}
// @codeCoverageIgnoreEnd
