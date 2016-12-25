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

    class HomepageOnboardingSnippet
    {
        public function render(Document $document): Element
        {
            $card = $document->createElement('div');
            $card->setClassName('generic-card -center');

            $title = $document->createElement('h2');
            $title->setClassName('basic-heading-a _margin-after-xs');
            $title->appendText('Welcome to timetab.io');
            $card->appendChild($title);

            $text = $document->createElement('p');
            $text->setClassName('_margin-after-m');
            $text->appendText('Create a feed to start sharing.');
            $card->appendChild($text);

            $button = $document->createElement('a');
            $button->setClassName('basic-button');
            $button->setAttribute('href', '/account/feeds/new');
            $button->appendText('Create Feed');
            $card->appendChild($button);

            return $card;
        }
    }
}
