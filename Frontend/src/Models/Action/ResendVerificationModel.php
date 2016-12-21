<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class ResendVerificationModel extends ActionModel
    {
        /**
         * @var string
         */
        private $email;

        public function getEmail(): string
        {
            return $this->email;
        }

        public function setEmail(string $email)
        {
            $this->email = $email;
        }
    }
}
