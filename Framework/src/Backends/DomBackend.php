<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
