<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Tasks
{
    use Timetabio\Library\TaskPriorities\Priority;

    class BuildPostTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $postId;

        /**
         * @var Priority
         */
        private $priority;

        public function __construct(string $postId, Priority $priority = null)
        {
            $this->postId = $postId;
            $this->priority = $priority;
        }

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            if ($this->priority === null) {
                return new \Timetabio\Library\TaskPriorities\Low;
            }

            return $this->priority;
        }
    }
}
