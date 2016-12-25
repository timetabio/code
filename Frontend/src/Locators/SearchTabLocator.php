<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Locators
{
    use Timetabio\Frontend\Tabs\Tab;
    use Timetabio\Library\SearchTypes\SearchType;

    class SearchTabLocator
    {
        public function locate(SearchType $searchType): Tab
        {
            $type = get_class($searchType);

            switch ($type) {
                case \Timetabio\Library\SearchTypes\All::class:
                    return new \Timetabio\Frontend\Tabs\SearchPage\Everything;
                case \Timetabio\Library\SearchTypes\Post::class:
                    return new \Timetabio\Frontend\Tabs\SearchPage\Posts;
                case \Timetabio\Library\SearchTypes\Feed::class:
                    return new \Timetabio\Frontend\Tabs\SearchPage\Feeds;
            }

            throw new \RuntimeException('unable to locate tab for type "' . $type . '"');
        }
    }
}
