<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Profile
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\Username;

    class ProfileModel extends APIModel
    {
        /**
         * @var Username
         */
        private $username;

        public function getUsername(): Username
        {
            return $this->username;
        }

        public function setUsername(Username $username)
        {
            $this->username = $username;
        }
    }
}
