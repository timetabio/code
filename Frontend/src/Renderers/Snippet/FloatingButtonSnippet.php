<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;

    class FloatingButtonSnippet
    {
        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        public function __construct(IconSnippet $iconSnippet)
        {
            $this->iconSnippet = $iconSnippet;
        }

        public function render(Document $document, string $icon, string $link, string $label): Element
        {
            $linkElement = $document->createElement('a');

            $linkElement->setClassName('floating-button');
            $linkElement->setAttribute('href', $link);
            $linkElement->setAttribute('role', 'button');
            $linkElement->setAttribute('title', $label);

            $linkElement->appendChild($this->iconSnippet->render($document, $icon, 'icon'));

            $labelElement = $document->createElement('span');
            $labelElement->setClassName('label');
            $labelElement->appendText($label);

            $linkElement->appendChild($labelElement);

            return $linkElement;
        }
    }
}
