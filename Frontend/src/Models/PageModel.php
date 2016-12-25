<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models
{
    class PageModel extends FrontendModel
    {
        /**
         * @var string
         */
        private $title = '';

        /**
         * @var string
         */
        private $canonicalUri;

        /**
         * @var boolean
         */
        private $trackingDisabled = false;

        public function setTitle(string $title)
        {
            $this->title = $title;
        }

        public function getTitle(): string
        {
            return $this->title;
        }

        public function getCanonicalUri(): string
        {
            return $this->canonicalUri;
        }

        public function setCanonicalUri(string $canonicalUri)
        {
            $this->canonicalUri = $canonicalUri;
        }

        public function hasCanonicalUri(): bool
        {
            return $this->canonicalUri !== null;
        }

        public function isTrackingDisabled(): bool
        {
            return $this->trackingDisabled;
        }

        public function disableTracking()
        {
            $this->trackingDisabled = true;
        }
    }
}
