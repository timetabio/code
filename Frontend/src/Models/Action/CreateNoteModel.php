<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class CreateNoteModel extends ActionModel
    {
        /**
         * @var string
         */
        private $feedId;

        /**
         * @var string
         */
        private $postTitle;

        /**
         * @var string
         */
        private $postBody;

        /**
         * @var array
         */
        private $attachments = [];

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }

        public function getPostTitle(): string
        {
            return $this->postTitle;
        }

        public function setPostTitle(string $postTitle)
        {
            $this->postTitle = $postTitle;
        }

        public function getPostBody(): string
        {
            return $this->postBody;
        }

        public function setPostBody(string $postBody)
        {
            $this->postBody = $postBody;
        }

        public function getAttachments(): array
        {
            return $this->attachments;
        }

        public function addAttachment(string $attachment)
        {
            $this->attachments[] = $attachment;
        }
    }
}
