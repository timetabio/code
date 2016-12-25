<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Renderers
{
    use Timetabio\Framework\Backends\DomBackend;
    use Timetabio\Worker\Transformations\TranslateTransformation;

    class StaticPageRenderer
    {
        /**
         * @var DomBackend
         */
        private $domBackend;

        /**
         * @var TranslateTransformation
         */
        private $translateTransformation;

        public function __construct(DomBackend $domBackend, TranslateTransformation $translateTransformation)
        {
            $this->domBackend = $domBackend;
            $this->translateTransformation = $translateTransformation;
        }

        public function render(string $content): string
        {
            $document = $this->domBackend->loadHtml('templates://' . $content);

            $this->translateTransformation->apply($document);

            return $document->saveHTML($document->documentElement);
        }
    }
}
