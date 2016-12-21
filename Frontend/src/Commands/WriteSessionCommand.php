<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\DataStore\DataStoreWriter;
    use Timetabio\Frontend\Session\Session;

    class WriteSessionCommand
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(Session $session)
        {
            $this->dataStoreWriter->setSessionData($session->getSessionId(), $session->getData());
            $this->dataStoreWriter->expireSessionData($session->getSessionId(), $session->getExpires());
        }
    }
}
