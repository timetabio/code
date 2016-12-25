<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\Verify
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\ValueObjects\Token;

    class VerifyModel extends APIModel
    {
        /**
         * @var Token
         */
        private $token;

        public function getToken(): Token
        {
            return $this->token;
        }

        public function setToken(Token $token)
        {
            $this->token = $token;
        }
    }
}
