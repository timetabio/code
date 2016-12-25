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
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Library\DataObjects\StaticPage;

    class StaticPageModel extends PageModel
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var LanguageInterface
         */
        private $language;

        /**
         * @var StaticPage
         */
        private $staticPage;

        public function __construct(string $name, LanguageInterface $language)
        {
            $this->name = $name;
            $this->language = $language;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getLanguage(): LanguageInterface
        {
            return $this->language;
        }

        public function getStaticPage(): StaticPage
        {
            return $this->staticPage;
        }

        public function setStaticPage(StaticPage $staticPage)
        {
            $this->staticPage = $staticPage;
        }
    }
}
