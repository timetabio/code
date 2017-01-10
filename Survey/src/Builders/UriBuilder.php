<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Builders
{
    class UriBuilder
    {
        /**
         * @var string
         */
        private $uriHost;

        public function __construct(string $uriHost)
        {
            $this->uriHost = $uriHost;
        }

        public function buildSurveyThanksPage(string $version): string
        {
            if ($version === 'post') {
                return $this->uriHost;
            }

            return $this->uriHost . '/survey/thanks';
        }
    }
}
