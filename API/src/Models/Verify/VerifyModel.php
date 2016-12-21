<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Verify
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\ValueObjects\Token;

    class VerifyModel extends APIModel
    {
        /**
         * @var Token
         */
        private $token;

        public function getToken(): Token
        {
            return $this->token;
        }

        public function setToken(Token $token)
        {
            $this->token = $token;
        }
    }
}
