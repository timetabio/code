<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\DataStore
{
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Framework\Map\MapInterface;
    use Timetabio\Library\DataObjects\StaticPage;
    use Timetabio\Library\DataStore\AbstractDataStoreReader;

    class DataStoreReader extends AbstractDataStoreReader
    {
        public function getSystemToken(): string
        {
            return $this->getDataStore()->get('system_token');
        }

        public function hasSessionData(string $sessionId)
        {
            return $this->getDataStore()->has('session_data_' . $sessionId);
        }

        public function getSessionData(string $sessionId): MapInterface
        {
            return unserialize($this->getDataStore()->get('session_data_' . $sessionId));
        }

        public function getStaticPage(string $name, LanguageInterface $language): StaticPage
        {
            return unserialize($this->getDataStore()->getFromHash('static_pages_' . $language, $name));
        }

        public function hasRoute(string $path)
        {
            return $this->getDataStore()->hasInHash('static_routes', $path);
        }

        public function getRoute(string $path): string
        {
            return $this->getDataStore()->getFromHash('static_routes', $path);
        }
    }
}
