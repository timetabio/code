<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\{
        Document, Element
    };

    class IconButtonSnippet
    {
        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        public function __construct(IconSnippet $iconSnippet)
        {
            $this->iconSnippet = $iconSnippet;
        }

        public function render(Document $document, string $icon, string $label, string $variant = null): Element
        {
            $className = 'light-button';

            if ($variant !== null) {
                $className = 'light-button ' . $variant;
            }

            $button = $document->createElement('button');
            $button->setClassName($className);

            $buttonInner = $document->createElement('span');
            $buttonInner->setClassName('inner');
            $button->appendChild($buttonInner);

            $buttonInner->appendChild($this->iconSnippet->render($document, $icon, 'icon'));

            $buttonLabel = $document->createElement('span');
            $buttonLabel->setClassName('label');
            $buttonLabel->appendText($label);
            $buttonInner->appendChild($buttonLabel);

            return $button;
        }
    }
}
