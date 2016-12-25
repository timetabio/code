<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Account
{
    use Timetabio\Frontend\Models\PageModel;

    class VerifyModel extends PageModel
    {
        /**
         * @var string
         */
        private $token;

        public function getToken(): string
        {
            return $this->token;
        }

        public function setToken(string $token)
        {
            $this->token = $token;
        }
    }
}
