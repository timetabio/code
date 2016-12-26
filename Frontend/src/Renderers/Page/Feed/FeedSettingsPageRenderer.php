<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page\Feed
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\Page\FeedSettingsPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;
    use Timetabio\Frontend\Renderers\Snippet\IconButtonSnippet;
    use Timetabio\Frontend\ValueObjects\Feed;

    class FeedSettingsPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var IconButtonSnippet
         */
        private $iconButtonSnippet;

        public function __construct(IconButtonSnippet $iconButtonSnippet)
        {
            $this->iconButtonSnippet = $iconButtonSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var FeedSettingsPageModel $model */

            $feed = $model->getFeed();
            $main = $template->getMainElement();

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding');
            $main->appendChild($wrapper);

            if ($feed->hasEditAccess()) {
                $wrapper->appendChild($this->renderNameForm($template, $feed));
                $wrapper->appendChild($this->renderDescriptionForm($template, $feed));
                $wrapper->appendChild($this->renderVanityForm($template, $feed));
            }

            if ($feed->canUserUnfollow()) {
                $wrapper->appendChild($this->renderUnfollowForm($template, $feed));
            }
        }

        private function renderNameForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $feedNameTitle = $template->createElement('h2');
            $feedNameTitle->setClassName('basic-heading-b _margin-after-s');
            $feedNameTitle->appendText('Feed Name');
            $fragment->appendChild($feedNameTitle);

            $feedNameForm = $template->createElement('form');
            $feedNameForm->setClassName('form-card _margin-after-l');
            $feedNameForm->setAttribute('is', 'ajax-form');
            $feedNameForm->setAttribute('action', '/action/feed/update-name');
            $fragment->appendChild($feedNameForm);

            $feedNameInput = $template->createElement('input');
            $feedNameInput->setClassName('text');
            $feedNameInput->setAttribute('is', 'validated-input');
            $feedNameInput->setAttribute('max-byte-size', '64');
            $feedNameInput->setAttribute('name', 'name');
            $feedNameInput->setAttribute('placeholder', 'Explorations of Space-Time');
            $feedNameInput->setAttribute('required', '');
            $feedNameInput->setAttribute('value', $feed->getName());
            $feedNameForm->appendChild($feedNameInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedNameForm->appendChild($feedIdInput);

            $feedNameSaveButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $feedNameSaveButton->setAttribute('type', 'submit');
            $feedNameForm->appendChild($feedNameSaveButton);

            return $fragment;
        }

        private function renderDescriptionForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $feedDescriptionTitle = $template->createElement('h2');
            $feedDescriptionTitle->setClassName('basic-heading-b _margin-after-s');
            $feedDescriptionTitle->appendText('Feed Description');
            $fragment->appendChild($feedDescriptionTitle);

            $feedDescriptionForm = $template->createElement('form');
            $feedDescriptionForm->setClassName('form-card _margin-after-l');
            $feedDescriptionForm->setAttribute('is', 'ajax-form');
            $feedDescriptionForm->setAttribute('action', '/action/feed/update-description');
            $fragment->appendChild($feedDescriptionForm);

            $feedDescriptionInput = $template->createElement('input');
            $feedDescriptionInput->setClassName('text');
            $feedDescriptionInput->setAttribute('is', 'validated-input');
            $feedDescriptionInput->setAttribute('max-byte-size', '140');
            $feedDescriptionInput->setAttribute('name', 'description');
            $feedDescriptionInput->setAttribute('placeholder', 'Describe your feed in a few short words');
            $feedDescriptionInput->setAttribute('value', $feed->getDescription());
            $feedDescriptionForm->appendChild($feedDescriptionInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedDescriptionForm->appendChild($feedIdInput);

            $feedDescriptionSaveButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $feedDescriptionSaveButton->setAttribute('type', 'submit');
            $feedDescriptionForm->appendChild($feedDescriptionSaveButton);

            return $fragment;
        }

        private function renderVanityForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $feedUrlTitle = $template->createElement('h2');
            $feedUrlTitle->setClassName('basic-heading-b _margin-after-s');
            $feedUrlTitle->appendText('URL');
            $fragment->appendChild($feedUrlTitle);

            $feedUrlForm = $template->createElement('form');
            $feedUrlForm->setClassName('form-card _margin-after-l');
            $feedUrlForm->setAttribute('is', 'ajax-form');
            $feedUrlForm->setAttribute('action', '/action/feed/update-vanity');
            $fragment->appendChild($feedUrlForm);

            $feedUrlText = $template->createElement('span');
            $feedUrlText->setClassName('text');
            $feedUrlForm->appendChild($feedUrlText);

            $feedUrlMeta = $template->createElement('span');
            $feedUrlMeta->setClassName('meta');
            $feedUrlMeta->appendText('timetab.io/feed/');
            $feedUrlText->appendChild($feedUrlMeta);

            $feedUrlInput = $template->createElement('input');
            $feedUrlInput->setClassName('content');
            $feedUrlInput->setAttribute('is', 'validated-input');
            $feedUrlInput->setAttribute('max-byte-size', '20');
            $feedUrlInput->setAttribute('pattern', '[\w-]+');
            $feedUrlInput->setAttribute('name', 'vanity');
            $feedUrlInput->setAttribute('placeholder', 'your-feed-name');
            $feedUrlInput->setAttribute('value', $feed->getVanity());
            $feedUrlText->appendChild($feedUrlInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedUrlForm->appendChild($feedIdInput);

            $feedUrlSaveButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $feedUrlSaveButton->setAttribute('type', 'submit');
            $feedUrlForm->appendChild($feedUrlSaveButton);

            return $fragment;
        }

        private function renderUnfollowForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $feedUnfollowTitle = $template->createElement('h2');
            $feedUnfollowTitle->setClassName('basic-heading-b _margin-after-s');
            $feedUnfollowTitle->appendText('Unfollow');
            $fragment->appendChild($feedUnfollowTitle);

            $feedUnfollowForm = $template->createElement('form');
            $feedUnfollowForm->setClassName('form-card _margin-after-l');
            $feedUnfollowForm->setAttribute('is', 'ajax-form');
            $feedUnfollowForm->setAttribute('action', '/action/unfollow');
            $feedUnfollowForm->setAttribute('autocomplete', 'off');
            $fragment->appendChild($feedUnfollowForm);

            $feedUnfollowInput = $template->createElement('input');
            $feedUnfollowInput->setClassName('text');
            $feedUnfollowInput->setAttribute('is', 'validated-input');
            $feedUnfollowInput->setAttribute('string-match', $feed->getName());
            $feedUnfollowInput->setAttribute('name', 'unfollow');
            $feedUnfollowInput->setAttribute('placeholder', 'Enter the feed\'s name to confirm');
            $feedUnfollowForm->appendChild($feedUnfollowInput);

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $feedUnfollowForm->appendChild($feedIdInput);

            $feedUnfollowButton = $template->createElement('button');
            $feedUnfollowButton->setClassName('light-button -color');
            $feedUnfollowButton->setAttribute('type', 'submit');
            $feedUnfollowButton->setAttribute('disabled', '');
            $feedUnfollowButton->appendText('Unfollow');
            $feedUnfollowForm->appendChild($feedUnfollowButton);

            return $fragment;
        }
    }
}
