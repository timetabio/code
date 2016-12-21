<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Locators
{
    class SearchTypeLocator
    {
        public function locate(string $type): \Timetabio\Library\SearchTypes\SearchType
        {
            switch($type) {
                case 'all':
                    return new \Timetabio\Library\SearchTypes\All;
                case 'post':
                    return new \Timetabio\Library\SearchTypes\Post;
                case 'feed':
                    return new \Timetabio\Library\SearchTypes\Feed;
            }

            throw new \Exception('unable to locate type "' . $type . '"');
        }
    }
}
