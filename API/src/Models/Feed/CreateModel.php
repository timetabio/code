<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\Feed
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\FeedDescription;
    use Timetabio\API\ValueObjects\FeedName;

    class CreateModel extends APIModel
    {
        /**
         * @var FeedName
         */
        private $name;

        /**
         * @var bool
         */
        private $private;

        /**
         * @var FeedDescription
         */
        private $description;

        public function getName(): FeedName
        {
            return $this->name;
        }

        public function setName(FeedName $name)
        {
            $this->name = $name;
        }

        public function isPrivate(): bool
        {
            return $this->private;
        }

        public function setPrivate(bool $private)
        {
            $this->private = $private;
        }

        public function getDescription(): FeedDescription
        {
            return $this->description;
        }

        public function setDescription(FeedDescription $description)
        {
            $this->description = $description;
        }
    }
}
