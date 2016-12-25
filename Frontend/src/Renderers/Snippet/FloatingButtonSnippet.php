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
