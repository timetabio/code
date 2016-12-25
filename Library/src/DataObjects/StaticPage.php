<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\DataObjects
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class StaticPage
    {
        /**
         * @var string
         */
        private $title;

        /**
         * @var string
         */
        private $content;

        /**
         * @var StatusCodeInterface
         */
        private $code;

        /**
         * @var bool
         */
        private $showHeader;

        public function __construct(string $title, string $content, StatusCodeInterface $code = null, bool $showHeader = true)
        {
            $this->title = $title;
            $this->content = $content;
            $this->code = $code;
            $this->showHeader = $showHeader;
        }

        public function getTitle(): string
        {
            return $this->title;
        }

        public function getContent(): string
        {
            return $this->content;
        }

        public function hasCode(): bool
        {
            return $this->code !== null;
        }

        public function getCode(): StatusCodeInterface
        {
            return $this->code;
        }

        public function getShowHeader(): bool
        {
            return $this->showHeader;
        }
    }
}
