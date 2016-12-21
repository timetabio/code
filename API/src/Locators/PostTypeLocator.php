<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Locators
{
    use Timetabio\Library\PostTypes\PostTypeInterface;

    class PostTypeLocator
    {
        public function locate(string $type): PostTypeInterface
        {
            switch ($type) {
                case 'note':
                    return new \Timetabio\Library\PostTypes\Note;
                case 'task':
                    return new \Timetabio\Library\PostTypes\Task;
                case 'event':
                    return new \Timetabio\Library\PostTypes\Event;
            }

            throw new \Exception('invalid post type \'' . $type . '\'');
        }
    }
}
