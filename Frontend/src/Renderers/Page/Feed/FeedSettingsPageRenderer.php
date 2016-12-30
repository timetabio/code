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
    use Timetabio\Framework\Dom\Element;
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

            $titleElement = $template->createElement('h2');
            $titleElement->setClassName('basic-heading-b _margin-after-s');
            $titleElement->appendText('Feed Name');
            $fragment->appendChild($titleElement);

            $formElement = $template->createElement('form');
            $formElement->setClassName('form-card _margin-after-l');
            $formElement->setAttribute('is', 'ajax-form');
            $formElement->setAttribute('action', '/action/feed/update-name');
            $fragment->appendChild($formElement);

            $nameInput = $template->createElement('input');
            $nameInput->setClassName('text');
            $nameInput->setAttribute('is', 'validated-input');
            $nameInput->setAttribute('max-byte-size', '64');
            $nameInput->setAttribute('name', 'name');
            $nameInput->setAttribute('placeholder', 'Explorations of Space-Time');
            $nameInput->setAttribute('required', '');
            $nameInput->setAttribute('value', $feed->getName());
            $formElement->appendChild($nameInput);

            $formElement->appendChild($this->renderFeedIdInput($template, $feed));

            $submitButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $submitButton->setAttribute('type', 'submit');
            $formElement->appendChild($submitButton);

            return $fragment;
        }

        private function renderDescriptionForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $titleElement = $template->createElement('h2');
            $titleElement->setClassName('basic-heading-b _margin-after-s');
            $titleElement->appendText('Feed Description');
            $fragment->appendChild($titleElement);

            $formElement = $template->createElement('form');
            $formElement->setClassName('form-card _margin-after-l');
            $formElement->setAttribute('is', 'ajax-form');
            $formElement->setAttribute('action', '/action/feed/update-description');
            $fragment->appendChild($formElement);

            $descriptionInput = $template->createElement('input');
            $descriptionInput->setClassName('text');
            $descriptionInput->setAttribute('is', 'validated-input');
            $descriptionInput->setAttribute('max-byte-size', '140');
            $descriptionInput->setAttribute('name', 'description');
            $descriptionInput->setAttribute('placeholder', 'Describe your feed in a few short words');
            $descriptionInput->setAttribute('value', $feed->getDescription());
            $formElement->appendChild($descriptionInput);

            $formElement->appendChild($this->renderFeedIdInput($template, $feed));

            $submitButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $submitButton->setAttribute('type', 'submit');
            $formElement->appendChild($submitButton);

            return $fragment;
        }

        private function renderVanityForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $titleElement = $template->createElement('h2');
            $titleElement->setClassName('basic-heading-b _margin-after-s');
            $titleElement->appendText('URL');
            $fragment->appendChild($titleElement);

            $formElement = $template->createElement('form');
            $formElement->setClassName('form-card _margin-after-l');
            $formElement->setAttribute('is', 'ajax-form');
            $formElement->setAttribute('action', '/action/feed/update-vanity');
            $fragment->appendChild($formElement);

            $textElement = $template->createElement('span');
            $textElement->setClassName('text');
            $formElement->appendChild($textElement);

            $metaElement = $template->createElement('span');
            $metaElement->setClassName('meta');
            $metaElement->appendText('timetab.io/feed/');
            $textElement->appendChild($metaElement);

            $vanityInput = $template->createElement('input');
            $vanityInput->setClassName('content');
            $vanityInput->setAttribute('is', 'validated-input');
            $vanityInput->setAttribute('max-byte-size', '20');
            $vanityInput->setAttribute('pattern', '[\w-]+');
            $vanityInput->setAttribute('name', 'vanity');
            $vanityInput->setAttribute('placeholder', 'your-feed-name');
            $vanityInput->setAttribute('value', $feed->getVanity());
            $textElement->appendChild($vanityInput);

            $formElement->appendChild($this->renderFeedIdInput($template, $feed));

            $submitButton = $this->iconButtonSnippet->render($template, 'done', 'Save', '-color');
            $submitButton->setAttribute('type', 'submit');
            $formElement->appendChild($submitButton);

            return $fragment;
        }

        private function renderUnfollowForm(Document $template, Feed $feed): \DOMNode
        {
            $fragment = $template->createDocumentFragment();

            $titleElement = $template->createElement('h2');
            $titleElement->setClassName('basic-heading-b _margin-after-s');
            $titleElement->appendText('Unfollow');
            $fragment->appendChild($titleElement);

            $formElement = $template->createElement('form');
            $formElement->setClassName('form-card _margin-after-l');
            $formElement->setAttribute('is', 'ajax-form');
            $formElement->setAttribute('action', '/action/unfollow');
            $formElement->setAttribute('autocomplete', 'off');
            $fragment->appendChild($formElement);

            $nameInput = $template->createElement('input');
            $nameInput->setClassName('text');
            $nameInput->setAttribute('is', 'validated-input');
            $nameInput->setAttribute('string-match', $feed->getName());
            $nameInput->setAttribute('name', 'unfollow');
            $nameInput->setAttribute('placeholder', 'Enter the feed\'s name to confirm');
            $formElement->appendChild($nameInput);

            $formElement->appendChild($this->renderFeedIdInput($template, $feed));

            $submitButton = $template->createElement('button');
            $submitButton->setClassName('light-button -color');
            $submitButton->setAttribute('type', 'submit');
            $submitButton->setAttribute('disabled', '');
            $submitButton->appendText('Unfollow');
            $formElement->appendChild($submitButton);

            return $fragment;
        }

        private function renderFeedIdInput(Document $template, Feed $feed): Element
        {
            $inputElement = $template->createElement('input');

            $inputElement->setAttribute('type', 'hidden');
            $inputElement->setAttribute('name', 'feed_id');
            $inputElement->setAttribute('value', $feed->getId());

            return $inputElement;
        }
    }
}
