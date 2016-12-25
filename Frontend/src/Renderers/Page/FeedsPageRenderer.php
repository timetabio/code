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
    use Timetabio\Framework\Dom\{
        Document, Element
    };
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\FeedsPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Snippet\FeedCardSnippet;
    use Timetabio\Frontend\Renderers\Snippet\FloatingButtonSnippet;
    use Timetabio\Frontend\Renderers\Snippet\HomepageNavigationSnippet;
    use Timetabio\Frontend\Renderers\Snippet\HomepageOnboardingSnippet;
    use Timetabio\Frontend\Renderers\Snippet\PaginationButtonSnippet;

    class FeedsPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FeedCardSnippet
         */
        private $feedCardSnippet;

        /**
         * @var PaginationButtonSnippet
         */
        private $paginationButtonSnippet;

        /**
         * @var HomepageNavigationSnippet
         */
        private $homepageNavigationSnippet;

        /**
         * @var HomepageOnboardingSnippet
         */
        private $homepageOnboardingSnippet;

        /**
         * @var FloatingButtonSnippet
         */
        private $floatingButtonSnippet;

        public function __construct(
            FeedCardSnippet $feedCardSnippet,
            PaginationButtonSnippet $paginationButtonSnippet,
            HomepageNavigationSnippet $homepageNavigationSnippet,
            HomepageOnboardingSnippet $homepageOnboardingSnippet,
            FloatingButtonSnippet $floatingButtonSnippet
        )
        {
            $this->feedCardSnippet = $feedCardSnippet;
            $this->paginationButtonSnippet = $paginationButtonSnippet;
            $this->homepageNavigationSnippet = $homepageNavigationSnippet;
            $this->homepageOnboardingSnippet = $homepageOnboardingSnippet;
            $this->floatingButtonSnippet = $floatingButtonSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var FeedsPageModel $model */

            $feeds = $model->getFeeds();
            $main = $template->getMainElement();

            $floatingButtons = $template->createElement('nav');
            $floatingButtons->setClassName('floating-buttons');
            $main->appendChild($floatingButtons);

            $floatingButtons->appendChild($this->floatingButtonSnippet->render($template, 'feed', '/account/feeds/new', 'New Feed'));

            $main->appendChild($this->homepageNavigationSnippet->render($template, new \Timetabio\Frontend\Tabs\Homepage\Feeds));

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding -no-padding-top');
            $main->appendChild($wrapper);

            if ($feeds->getTotal() === 0) {
                $wrapper->appendChild($this->homepageOnboardingSnippet->render($template));
                return;
            }

            $listElement = $template->createElement('paginated-view');
            $listElement->setAttribute('endpoint-uri', '/fragment/user-feeds');
            $listElement->setAttribute('total-pages', $feeds->getPages());
            $wrapper->appendChild($listElement);

            $feedsElement = $template->createElement('paginated-list');
            $feedsElement->setClassName('post-list -smaller-margin');
            $listElement->appendChild($feedsElement);

            foreach ($feeds as $feed) {
                $feedsElement->appendChild(
                    $this->feedCardSnippet->render($template, $feed)
                );
            }

            $listElement->appendChild($this->paginationButtonSnippet->render($template, $feeds));
        }
    }
}
