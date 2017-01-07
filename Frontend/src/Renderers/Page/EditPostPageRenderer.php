<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Models\PostPageModel;
    use Timetabio\Frontend\Renderers\Snippet\IconSnippet;
    use Timetabio\Library\Builders\UriBuilder;

    class EditPostPageRenderer implements PageRendererInterface
    {
        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(IconSnippet $iconSnippet, UriBuilder $uriBuilder)
        {
            $this->iconSnippet = $iconSnippet;
            $this->uriBuilder = $uriBuilder;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var PostPageModel $model */

            $main = $template->getMainElement();
            $post = $model->getPost();
            $feed = $post['feed'];

            $wrapperElement = $template->createElement('div');
            $wrapperElement->setClassName('page-wrapper -padding');

            $main->appendChild($wrapperElement);

            $formElement = $template->createElement('autosave-form');
            $wrapperElement->appendChild($formElement);

            $cardElement = $template->createElement('file-drop');
            $cardElement->setClassName('post-card');
            $cardElement->setAttribute('append-to', '.attachments');
            $cardElement->setAttribute('file-element', 'post-attachment');
            $formElement->appendChild($cardElement);

            $headerElement = $template->createElement('header');
            $headerElement->setClassName('header');
            $cardElement->appendChild($headerElement);

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
            $titleInputElement->setClassName('title');
            $titleInputElement->setAttribute('placeholder', 'Title');
            $titleInputElement->setAttribute('name', 'title');
            $titleInputElement->setAttribute('autocomplete', 'off');
            $titleInputElement->setAttribute('value', $post['title']);
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
            $textareaElement->setAttribute('placeholder', 'Write something...');
            $textareaElement->appendText($post['body']);
            $bodyElement->appendChild($textareaElement);

            $attachmentsElement = $template->createElement('div');
            $attachmentsElement->setClassName('attachments');
            $cardElement->appendChild($attachmentsElement);

            $formError = $template->createElement('form-error');
            $cardElement->appendChild($formError);

            $buttonsElement = $template->createElement('div');
            $buttonsElement->setClassName('buttons');
            $cardElement->appendChild($buttonsElement);

            $uploadMessage = $template->createElement('div');
            $uploadMessage->setClassName('post-card-outside-text');
            $uploadMessage->appendText('Attach files by dragging & dropping or ');
            $formElement->appendChild($uploadMessage);

            $uploadButton = $template->createElement('file-pick');
            $uploadButton->setClassName('basic-link');
            $uploadButton->appendText('selecting them');
            $uploadMessage->appendChild($uploadButton);
        }
    }
}
