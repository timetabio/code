<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
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
