<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Frontend\DataStore\DataStoreReader;
    use Timetabio\Library\DataObjects\StaticPage;

    class FetchStaticPageQuery
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(string $name, LanguageInterface $language): StaticPage
        {
            return $this->dataStoreReader->getStaticPage($name, $language);
        }
    }
}
