<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom;
    use Timetabio\Library\Builders\UriBuilder;

    class FeedCardSnippet
    {
        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        public function __construct(UriBuilder $uriBuilder, IconSnippet $iconSnippet)
        {
            $this->uriBuilder = $uriBuilder;
            $this->iconSnippet = $iconSnippet;
        }

        public function render(Dom\Document $document, array $feed): Dom\Element
        {
            $cardElement = $document->createElement('article');
            $cardElement->setClassName('feed-card');

            $icon = 'public';

            if ($feed['is_private']) {
                $icon = 'private';
            }

            $nameElement = $document->createElement('h2');
            $nameElement->setClassName('name');
            $cardElement->appendChild($nameElement);

            $nameElement->appendChild($this->iconSnippet->render($document, $icon, 'icon'));

            $linkElement = $document->createElement('a');
            $linkElement->setClassName('basic-link -no-bold');
            $linkElement->setAttribute('href', $this->uriBuilder->buildFeedPageUri($feed['id']));
            $linkElement->appendText($feed['name']);
            $nameElement->appendChild($linkElement);

            if (!empty($feed['description'])) {
                $descriptionElement = $document->createElement('p');
                $descriptionElement->setClassName('description');
                $descriptionElement->appendText($feed['description']);
                $cardElement->appendChild($descriptionElement);
            }

            return $cardElement;
        }
    }
}
