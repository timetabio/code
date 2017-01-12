<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\Post
{
    use Timetabio\API\ValueObjects\PostBody;

    class UpdateBodyModel extends PostModel
    {
        /**
         * @var PostBody
         */
        private $postBody;

        public function getPostBody(): PostBody
        {
            return $this->postBody;
        }

        public function setPostBody(PostBody $postBody)
        {
            $this->postBody = $postBody;
        }
    }
}
