<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class ResetModel extends ActionModel
    {
        /**
         * @var string
         */
        private $resetToken;

        /**
         * @var string
         */
        private $password;

        public function getResetToken(): string
        {
            return $this->resetToken;
        }

        public function setResetToken(string $resetToken)
        {
            $this->resetToken = $resetToken;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function setPassword(string $password)
        {
            $this->password = $password;
        }
    }
}
