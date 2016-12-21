<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;

    class IconSnippet
    {
        public function render(Dom\Document $document, string $iconName, string $className): Dom\Element
        {
            $svgElement = $document->createElement('svg');
            $svgElement->setClassName($className);

            $useElement = $document->createElement('use');
            $useElement->setAttribute('xlink:href', '/icons/' . $iconName . '.svg#icon');
            $svgElement->appendChild($useElement);

            return $svgElement;
        }
    }
}
