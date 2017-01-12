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

        public function render(Document $document, string $icon, string $label, string $variant = null, bool $button = true): Element
        {
            $className = 'light-button';
            $tagName = 'button';

            if ($variant !== null) {
                $className = 'light-button ' . $variant;
            }

            if (!$button) {
                $tagName = 'a';
            }

            $button = $document->createElement($tagName);
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
