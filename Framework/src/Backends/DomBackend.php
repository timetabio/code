<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends
{
    use Timetabio\Framework\Dom\Document;

    class DomBackend
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        public function __construct(FileBackend $fileBackend)
        {
            $this->fileBackend = $fileBackend;
        }

        public function loadXml(string $fileName): Document
        {
            $document = new Document;

            $document->loadXML($this->fileBackend->read($fileName));

            return $document;
        }

        public function loadHtml(string $fileName): Document
        {
            $document = new Document;

            $document->loadHTML($this->fileBackend->read($fileName), LIBXML_HTML_NOIMPLIED);

            return $document;
        }
    }
}
