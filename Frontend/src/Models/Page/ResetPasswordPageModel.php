<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\Models\PageModel;

    class ResetPasswordPageModel extends PageModel
    {
        /**
         * @var string
         */
        private $token;

        public function __construct(string $token)
        {
            $this->token = $token;
        }

        public function getToken(): string
        {
            return $this->token;
        }
    }
}
