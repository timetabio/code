<?php
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class ForgotModel extends ActionModel
    {
        /**
         * @var string
         */
        private $user;

        public function getUser(): string
        {
            return $this->user;
        }

        public function setUser(string $user)
        {
            $this->user = $user;
        }
    }
}
