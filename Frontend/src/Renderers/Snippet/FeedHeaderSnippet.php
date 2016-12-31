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
    use Timetabio\Frontend\ValueObjects\Feed;

    class FeedHeaderSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        public function __construct(IconSnippet $iconSnippet)
        {
            $this->iconSnippet = $iconSnippet;
        }

        public function render(Dom\Document $template, Feed $feed): Dom\Element
        {
            $translator = $this->getTranslator();

            $header = $template->createElement('header');
            $header->setClassName('feed-header');

            $title = $template->createElement('div');
            $title->setClassName('title');

            $header->appendChild($title);

            $text = $template->createElement('h1');
            $text->setClassName('text');
            $text->appendText($feed->getName());

            $title->appendChild($text);

            if ($feed->isVerified()) {
                $verifiedIcon = $this->iconSnippet->render($template, 'verified', 'verified');
                $title->appendChild($verifiedIcon);
            }

            if ($feed->hasDescription()) {
                $description = $template->createElement('div');
                $description->setClassName('description');
                $description->appendText($feed->getDescription());
                $header->appendChild($description);
            }

            $follow = $template->createElement('button');
            $follow->setClassName('button basic-button -small');
            $follow->setAttribute('is', 'ajax-button');
            $follow->setAttribute('post-data', json_encode(['feed_id' => $feed->getId()]));

            $label = 'Follow';
            $followUri = '/action/follow';

            if ($feed->hasUserAdded()) {
                $label = 'Unfollow';
                $followUri = '/action/unfollow';
            }

            $follow->setAttribute('post-uri', $followUri);
            $follow->appendText($translator->translate($label));

            if (!$feed->hasUserAdded()) {
                $header->appendChild($follow);
            }

            return $header;
        }
    }
}
