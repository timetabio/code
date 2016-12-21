<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Frontend\Session\Session;

    class IsLoggedInQuery
    {
        /**
         * @var Session
         */
        private $session;

        public function __construct(Session $session)
        {
            $this->session = $session;
        }

        public function execute(): bool
        {
            return $this->session->hasUser();
        }
    }
}
