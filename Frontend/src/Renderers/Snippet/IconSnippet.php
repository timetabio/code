<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
