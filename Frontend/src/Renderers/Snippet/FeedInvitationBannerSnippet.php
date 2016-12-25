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
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;

    class FeedInvitationBannerSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function render(Dom\Document $template): Dom\Element
        {
            $banner = $template->createElement('div');

            $banner->setClassName('page-banner');
            $banner->appendText($this->getTranslator()->translate('You have been invited to this feed. Add to gain extended access.'));

            return $banner;
        }
    }
}
