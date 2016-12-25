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
