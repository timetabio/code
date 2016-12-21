<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Account
{
    use Timetabio\Frontend\Models\PageModel;

    class VerifyModel extends PageModel
    {
        /**
         * @var string
         */
        private $token;

        public function getToken(): string
        {
            return $this->token;
        }

        public function setToken(string $token)
        {
            $this->token = $token;
        }
    }
}
