<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Frontend\Models\Page\SearchPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Snippet\FeedCardSnippet;
    use Timetabio\Frontend\Renderers\Snippet\PostSnippet;
    use Timetabio\Frontend\Renderers\Snippet\SearchTabNavSnippet;

    class SearchPageRenderer implements PageRendererInterface
    {
        /**
         * @var PostSnippet
         */
        private $postSnippet;

        /**
         * @var FeedCardSnippet
         */
        private $feedCardSnippet;

        /**
         * @var SearchTabNavSnippet
         */
        private $searchTabNavSnippet;

        public function __construct(
            PostSnippet $postSnippet,
            FeedCardSnippet $feedCardSnippet,
            SearchTabNavSnippet $searchTabNavSnippet
        )
        {
            $this->postSnippet = $postSnippet;
            $this->feedCardSnippet = $feedCardSnippet;
            $this->searchTabNavSnippet = $searchTabNavSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var SearchPageModel $model */

            $query = $model->getSearchQuery();
            $main = $template->getMainElement();

            $searchInput = $template->queryOne('//input[@name="q"]');
            $searchInput->setAttribute('value', $query);

            $navElement = $this->searchTabNavSnippet->render(
                $template,
                $model->getActiveTab(),
                $query
            );

            $navElement->setClassName('tab-nav -margin');
            $main->appendChild($navElement);

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding -no-padding-top');
            $main->appendChild($wrapper);

            $postsElement = $template->createElement('div');
            $postsElement->setClassName('post-list');
            $wrapper->appendChild($postsElement);

            foreach ($model->getSearchResults() as $result) {
                $postsElement->appendChild(
                    $this->renderResult($template, $result)
                );
            }
        }

        private function renderResult(Document $template, array $result): Element
        {
            switch ($result['type']) {
                case 'post':
                    return $this->renderPostCard($template, $result['data']);
                case 'feed':
                    return $this->feedCardSnippet->render($template, $result['data']);
            }

            throw new \RuntimeException('invalid result type');
        }

        private function renderPostCard(Document $template, array $post): Element
        {
            $post['rendered_body'] = $post['preview'];

            return $this->postSnippet->render($template, $post, $post['feed']);
        }
    }
}
