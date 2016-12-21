<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class SessionFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        /**
         * @var \Timetabio\Frontend\Session\Session
         */
        private $session;

        public function createSession()
        {
            if ($this->session === null) {
                $this->session = new \Timetabio\Frontend\Session\Session(
                    $this->getMasterFactory()->createDataStoreReader()
                );
            }

            return $this->session;
        }
    }
}
