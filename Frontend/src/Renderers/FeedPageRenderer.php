<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Page\FeedPostsPageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;
    use Timetabio\Frontend\Renderers\Snippet\FeedButtonsSnippet;
    use Timetabio\Frontend\Renderers\Snippet\FeedHeaderSnippet;
    use Timetabio\Frontend\Renderers\Snippet\FeedInvitationBannerSnippet;
    use Timetabio\Frontend\Renderers\Snippet\FeedNavigationSnippet;
    use Timetabio\Frontend\Transformations\Transformer;

    /**
     * @todo: Just got an idea... why don't we move this combination of snippets into the FeedHeader snippet... this would avoid this special-case renderer
     */
    class FeedPageRenderer extends PageRenderer
    {
        /**
         * @var FeedHeaderSnippet
         */
        private $feedHeaderSnippet;

        /**
         * @var FeedButtonsSnippet
         */
        private $feedButtonsSnippet;

        /**
         * @var FeedInvitationBannerSnippet
         */
        private $invitationBannerSnippet;

        /**
         * @var FeedNavigationSnippet
         */
        private $feedNavigationSnippet;

        public function __construct(
            Document $template,
            PageRendererInterface $pageRenderer,
            Transformer $transformer,
            FeedHeaderSnippet $feedHeaderSnippet,
            FeedButtonsSnippet $feedButtonsSnippet,
            FeedInvitationBannerSnippet $invitationBannerSnippet,
            FeedNavigationSnippet $feedNavigationSnippet
        )
        {
            parent::__construct($template, $pageRenderer, $transformer);

            $this->feedHeaderSnippet = $feedHeaderSnippet;
            $this->feedButtonsSnippet = $feedButtonsSnippet;
            $this->invitationBannerSnippet = $invitationBannerSnippet;
            $this->feedNavigationSnippet = $feedNavigationSnippet;
        }

        public function render(AbstractModel $model): string
        {
            /** @var FeedPostsPageModel $model */

            $feed = $model->getFeed();
            $template = $this->getTemplate();
            $main = $template->getMainElement();

            if ($feed->hasPostAccess()) {
                $main->appendChild($this->feedButtonsSnippet->render($template, $feed->getId()));
            }

            if ($feed->isUserInvited()) {
                $main->appendChild($this->invitationBannerSnippet->render($template));
            }

            $main->appendChild($this->feedHeaderSnippet->render($template, $feed));
            $main->appendChild($this->feedNavigationSnippet->render($template, $model->getActiveTab(), $feed));

            return parent::render($model);
        }
    }
}
