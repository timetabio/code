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
    use Timetabio\Library\Builders\UriBuilder;
    use Timetabio\Library\ValueObjects\DisplayName;

    class PostSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var IconSnippet
         */
        private $iconSnippet;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        /**
         * @var PostAttachmentSnippet
         */
        private $postAttachmentSnippet;

        public function __construct(IconSnippet $iconSnippet, UriBuilder $uriBuilder, PostAttachmentSnippet $postAttachmentSnippet)
        {
            $this->iconSnippet = $iconSnippet;
            $this->uriBuilder = $uriBuilder;
            $this->postAttachmentSnippet = $postAttachmentSnippet;
        }

        public function render(Dom\Document $template, array $post, array $feed = []): Dom\Element
        {
            $cardClass = 'post-card';

            if (isset($post['is_checked']) && $post['is_checked']) {
                $cardClass = 'post-card -done';
            }

            $card = $template->createElement('article');
            $card->setClassName($cardClass);

            $header = $template->createElement('header');
            $header->setClassName('header');
            $card->appendChild($header);

            $time = $template->createElement('time-ago');
            $time->setClassName('time');
            $time->setAttribute('datetime', gmdate('c', $post['created']));
            $time->appendText(date('d.m.Y H:i:s', $post['created']));
            $header->appendChild($time);

            $body = $template->createElement('div');
            $body->setClassName('body');
            $card->appendChild($body);

            $title = $template->createElement('h2');
            $title->setClassName('title');

            $body->appendChild($title);

            if ($post['type'] === 'task') {
                $checkbox = $template->createElement('label');
                $checkbox->setClassName('task-checkbox checkbox');
                $title->appendChild($checkbox);

                $checkboxInput = $template->createElement('input');
                $checkboxInput->setClassName('checkbox');
                $checkboxInput->setAttribute('type', 'checkbox');

                if (isset($post['is_checked']) && $post['is_checked']) {
                    $checkboxInput->setAttribute('checked', 'checked');
                }

                $checkbox->appendChild($checkboxInput);
                $checkbox->appendChild($this->iconSnippet->render($template, 'task', 'icon'));
            }

            $titleLink = $template->createElement('a');
            $titleLink->setAttribute('class', 'basic-link -no-bold');
            $titleLink->setAttribute('href', $this->uriBuilder->buildPostPageUri($post['id']));
            $titleLink->appendText($post['title']);
            $title->appendChild($titleLink);

            $subtitle = $template->createElement('div');
            $subtitle->setClassName('subtitle');
            $body->appendChild($subtitle);

            $subtitle->appendText(new DisplayName($post['author']));
            $subtitle->appendText(' • ');

            $feedLink = $template->createElement('a');
            $feedLink->setClassName('basic-link');
            $feedLink->setAttribute('href', $this->uriBuilder->buildFeedPageUri($feed['id']));
            $feedLink->appendText($feed['name']);
            $subtitle->appendChild($feedLink);

            if (!empty($post['rendered_body'])) {
                $content = $template->createElement('div');
                $content->setClassName('content post-content');

                $body->appendChild($content);

                $fragment = $template->createHTMLFragment($post['rendered_body']);

                $content->appendChild($fragment);
            }

            if (isset($post['attachments'])) {
                $attachmentsElement = $template->createElement('div');
                $attachmentsElement->setClassName('attachments');
                $card->appendChild($attachmentsElement);

                foreach ($post['attachments'] as $attachment) {
                    $attachmentsElement->appendChild(
                        $this->postAttachmentSnippet->render($template, $attachment)
                    );
                }
            }

            $buttons = $template->createElement('div');
            $buttons->setClassName('buttons');
            $card->appendChild($buttons);

            if (isset($feed['access']['post']) && $feed['access']['post']) {
                $deleteButtonData = [
                    'post_id' => $post['id'],
                    'feed_id' => $post['feed']['id']
                ];

                $deleteButton = $template->createElement('button');
                $deleteButton->setClassName('light-button');
                $deleteButton->setAttribute('is', 'ajax-button');
                $deleteButton->setAttribute('post-uri', '/action/posts/delete');
                $deleteButton->setAttribute('post-data', json_encode($deleteButtonData));

                $deleteButtonInner = $template->createElement('span');
                $deleteButtonInner->setClassName('inner');
                $deleteButton->appendChild($deleteButtonInner);

                $deleteIcon = $this->iconSnippet->render($template, 'actions/delete', 'icon');
                $deleteButtonInner->appendChild($deleteIcon);

                $deleteButtonInner->appendText($this->getTranslator()->translate('Delete'));

                $buttons->appendChild($deleteButton);
            }

            return $card;
        }
    }
}
