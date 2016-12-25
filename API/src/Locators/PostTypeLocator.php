<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
