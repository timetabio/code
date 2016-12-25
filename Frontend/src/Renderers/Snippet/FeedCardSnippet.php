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
