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
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\CreatePostPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Snippet\FeedButtonsSnippet;
    use Timetabio\Frontend\Renderers\Snippet\IconSnippet;
    use Timetabio\Library\Builders\UriBuilder;

    class CreatePostPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FeedButtonsSnippet
         */
        private $feedButtonsSnippet;

        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(FeedButtonsSnippet $feedButtonsSnippet, IconSnippet $iconSnippet, UriBuilder $uriBuilder)
        {
            $this->feedButtonsSnippet = $feedButtonsSnippet;
            $this->iconSnippet = $iconSnippet;
            $this->uriBuilder = $uriBuilder;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var CreatePostPageModel $model */

            $main = $template->getMainElement();
            $feed = $model->getFeedInfo();
            $feedId = $feed['id'];

            $main->appendChild($this->feedButtonsSnippet->render($template, $feedId));

            $wrapperElement = $template->createElement('div');
            $wrapperElement->setClassName('page-wrapper -padding');

            $main->appendChild($wrapperElement);

            $formElement = $template->createElement('form');
            $formElement->setAttribute('is', 'ajax-form');
            $formElement->setAttribute('method', 'post');
            $formElement->setAttribute('action', '/action/note/create');
            $wrapperElement->appendChild($formElement);

            $cardElement = $template->createElement('file-drop');
            $cardElement->setClassName('post-card');
            $cardElement->setAttribute('append-to', '.attachments');
            $cardElement->setAttribute('file-element', 'post-attachment');
            $formElement->appendChild($cardElement);

            $headerElement = $template->createElement('header');
            $headerElement->setClassName('header');
            $cardElement->appendChild($headerElement);

            /*$authorElement = $template->createElement('div');
            $authorElement->setClassName('author');
            $headerElement->appendChild($authorElement);

            $authorTextElement = $template->createElement('div');
            $authorTextElement->setClassName('text');
            $authorTextElement->appendText($model->getUser()->getDisplayName());
            $authorElement->appendChild($authorTextElement);*/

            $timeElement = $template->createElement('local-time');
            $timeElement->setClassName('time');
            $timeElement->setAttribute('month', 'long');
            $timeElement->setAttribute('day', 'numeric');
            $timeElement->setAttribute('year', 'numeric');
            $timeElement->setAttribute('datetime', date('c'));
            $timeElement->appendText(date('d.m.Y'));
            $headerElement->appendChild($timeElement);

            $bodyElement = $template->createElement('div');
            $bodyElement->setClassName('body');
            $cardElement->appendChild($bodyElement);

            $titleInputElement = $template->createElement('input');
            $titleInputElement->setAttribute('is', 'validated-input');
            $titleInputElement->setClassName('title');
            $titleInputElement->setAttribute('placeholder', $this->getTranslator()->translate('Title'));
            $titleInputElement->setAttribute('name', 'title');
            $titleInputElement->setAttribute('required', '');
            $titleInputElement->setAttribute('max-byte-size', '64');
            $titleInputElement->setAttribute('autocomplete', 'off');
            $bodyElement->appendChild($titleInputElement);

            $subtitle = $template->createElement('div');
            $subtitle->setClassName('subtitle');
            $bodyElement->appendChild($subtitle);

            $subtitle->appendText($model->getUser()->getDisplayName());
            $subtitle->appendText(' • ');

            $feedLink = $template->createElement('a');
            $feedLink->setClassName('basic-link');
            $feedLink->setAttribute('href', $this->uriBuilder->buildFeedPageUri($feed['id']));
            $feedLink->appendText($feed['name']);
            $subtitle->appendChild($feedLink);

            $textareaElement = $template->createElement('textarea');
            $textareaElement->setClassName('textarea');
            $textareaElement->setAttribute('is', 'auto-textarea');
            $textareaElement->setAttribute('name', 'body');
            $textareaElement->setAttribute('max-size', '8192');
            $textareaElement->setAttribute('placeholder', $this->getTranslator()->translate('Write something...'));
            $bodyElement->appendChild($textareaElement);

            $attachmentsElement = $template->createElement('div');
            $attachmentsElement->setClassName('attachments');
            $cardElement->appendChild($attachmentsElement);

            $formError = $template->createElement('form-error');
            $cardElement->appendChild($formError);

            $buttonsElement = $template->createElement('div');
            $buttonsElement->setClassName('buttons');
            $cardElement->appendChild($buttonsElement);

            $postButton = $template->createElement('button');
            $postButton->setClassName('light-button -color');
            $postButton->setAttribute('type', 'submit');
            $postButton->setAttribute('disabled', '');
            $buttonsElement->appendChild($postButton);

            $postButtonInner = $template->createElement('span');
            $postButtonInner->setClassName('inner');
            $postButton->appendChild($postButtonInner);

            $postButtonInner->appendChild($this->iconSnippet->render($template, 'actions/post', 'icon'));

            $postButtonText = $template->createElement('span');
            $postButtonText->setClassName('label');
            $postButtonInner->appendChild($postButtonText);

            $postButtonText->appendText($this->getTranslator()->translate('Post to'));
            $postButtonText->appendText(' ');

            $postButtonFeedName = $template->createElement('span');
            $postButtonFeedName->setClassName('name');
            $postButtonFeedName->appendText($feed['name']);
            $postButtonText->appendChild($postButtonFeedName);

            $uploadMessage = $template->createElement('div');
            $uploadMessage->setClassName('post-card-outside-text');
            $uploadMessage->appendText($this->getTranslator()->translate('Attach files by dragging & dropping or') . ' ');
            $formElement->appendChild($uploadMessage);

            $uploadButton = $template->createElement('file-pick');
            $uploadButton->setClassName('basic-link');
            $uploadButton->appendText($this->getTranslator()->translate('selecting them'));
            $uploadMessage->appendChild($uploadButton);

            $feedElement = $template->createElement('input');
            $feedElement->setAttribute('type', 'hidden');
            $feedElement->setAttribute('name', 'feed_id');
            $feedElement->setAttribute('value', $feedId);
            $formElement->appendChild($feedElement);
        }
    }
}
