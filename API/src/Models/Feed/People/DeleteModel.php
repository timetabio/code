<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\Feed\People
{
    use Timetabio\API\Models\Feed\FeedModel;
    use Timetabio\API\ValueObjects\UserId;

    class DeleteModel extends FeedModel
    {
        /**
         * @var UserId
         */
        private $userId;

        public function getUserId(): UserId
        {
            return $this->userId;
        }

        public function setUserId(UserId $userId)
        {
            $this->userId = $userId;
        }
    }
}
