<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
