<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;
    use Timetabio\Library\Builders\UriBuilder;

    class FeedListSnippet
    {
        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(UriBuilder $uriBuilder)
        {
            $this->uriBuilder = $uriBuilder;
        }

        public function render(Document $template, PaginatedResult $feeds): Element
        {
            $feedsElement = $template->createElement('nav');
            $feedsElement->setClassName('feed-list _margin-after');

            foreach ($feeds as $feed) {
                $feedsElement->appendChild($this->renderFeed($template, $feed));
            }

            return $feedsElement;
        }

        private function renderFeed(Document $template, array $feed): Element
        {
            $feedLink = $template->createElement('a');
            $feedLink->setClassName('item');
            $feedLink->setAttribute('href', $this->uriBuilder->buildFeedPageUri($feed['id']));

            $feedIcon = $template->createElement('svg');
            $feedIcon->setClassName('icon');
            $feedLink->appendChild($feedIcon);

            $iconName = 'public';

            if ($feed['is_private']) {
                $iconName = 'private';
            }

            $useElement = $template->createElement('use');
            $useElement->setAttribute('xlink:href', '/icons/' . $iconName . '.svg#icon');
            $feedIcon->appendChild($useElement);

            $feedLink->appendText($feed['name']);

            return $feedLink;
        }
    }
}
