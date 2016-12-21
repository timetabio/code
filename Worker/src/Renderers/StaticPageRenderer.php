<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
