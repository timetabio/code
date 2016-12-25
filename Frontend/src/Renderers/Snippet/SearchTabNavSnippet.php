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
    use Timetabio\Frontend\TabNavItems\SearchPage\Everything;
    use Timetabio\Frontend\TabNavItems\SearchPage\Feeds;
    use Timetabio\Frontend\TabNavItems\SearchPage\Posts;
    use Timetabio\Frontend\Tabs\Tab;
    use Timetabio\Library\Builders\UriBuilder;

    class SearchTabNavSnippet
    {
        /**
         * @var TabNavSnippet
         */
        private $tabNavSnippet;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(TabNavSnippet $tabNavSnippet, UriBuilder $uriBuilder)
        {
            $this->tabNavSnippet = $tabNavSnippet;
            $this->uriBuilder = $uriBuilder;
        }

        public function render(Document $document, Tab $active, string $query): Element
        {
            return $this->tabNavSnippet->render(
                $document,
                $active,
                new Everything($this->uriBuilder->buildSearchPageUri($query)),
                new Posts($this->uriBuilder->buildPostsSearchPageUri($query)),
                new Feeds($this->uriBuilder->buildFeedsSearchPageUri($query))
            );
        }
    }
}
