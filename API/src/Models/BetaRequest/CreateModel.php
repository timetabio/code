<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\BetaRequest
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class CreateModel extends APIModel
    {
        /**
         * @var EmailAddress
         */
        private $email;

        public function getEmail(): EmailAddress
        {
            return $this->email;
        }

        public function setEmail(EmailAddress $email)
        {
            $this->email = $email;
        }
    }
}
