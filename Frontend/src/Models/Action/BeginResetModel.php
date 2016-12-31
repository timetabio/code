<?php
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class BeginResetModel extends ActionModel
    {
        /**
         * @var string
         */
        private $inputUser;

        public function getInputUser(): string
        {
            return $this->inputUser;
        }

        public function setInputUser(string $user)
        {
            $this->inputUser = $user;
        }
    }
}
