<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
