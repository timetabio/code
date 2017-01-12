<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models
{
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    // TODO: Move this to Page\
    class FeedsPageModel extends PageModel
    {
        /**
         * @var PaginatedResult
         */
        private $feeds;

        public function getFeeds(): PaginatedResult
        {
            return $this->feeds;
        }

        public function setFeeds(PaginatedResult $feeds)
        {
            $this->feeds = $feeds;
        }
    }
}
