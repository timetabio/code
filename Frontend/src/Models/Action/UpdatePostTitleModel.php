<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class UpdatePostTitleModel extends ActionModel
    {
        /**
         * @var string
         */
        private $postId;

        /**
         * @var string
         */
        private $postTitle;

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function setPostId(string $postId)
        {
            $this->postId = $postId;
        }

        public function getPostTitle(): string
        {
            return $this->postTitle;
        }

        public function setPostTitle(string $postTitle)
        {
            $this->postTitle = $postTitle;
        }
    }
}
