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
    class IndexPostTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $postId;

        public function __construct(string $postId)
        {
            $this->postId = $postId;
        }

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Normal;
        }
    }
}
