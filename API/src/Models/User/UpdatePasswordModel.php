<?php
namespace Timetabio\API\Models\User
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\Password;

    class UpdateUserPasswordModel extends APIModel
    {
        /**
         * @var string
         */
        private $oldPassword;

        /**
         * @var Password
         */
        private $newPassword;

        public function getOldPassword(): string
        {
            return $this->oldPassword;
        }

        public function setOldPassword(string $oldPassword)
        {
            $this->oldPassword = $oldPassword;
        }

        public function getNewPassword(): Password
        {
            return $this->newPassword;
        }

        public function setNewPassword(Password $newPassword)
        {
            $this->newPassword = $newPassword;
        }
    }
}
