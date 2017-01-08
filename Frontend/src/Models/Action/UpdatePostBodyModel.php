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

    class UpdatePostBodyModel extends ActionModel
    {
        /**
         * @var string
         */
        private $postId;

        /**
         * @var string
         */
        private $postBody;

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function setPostId(string $postId)
        {
            $this->postId = $postId;
        }

        public function getPostBody(): string
        {
            return $this->postBody;
        }

        public function setPostBody(string $postBody)
        {
            $this->postBody = $postBody;
        }
    }
}
