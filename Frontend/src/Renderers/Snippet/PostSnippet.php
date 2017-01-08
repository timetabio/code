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

        /**
         * @var IconButtonSnippet
         */
        private $iconButtonSnippet;

        public function __construct(
            IconSnippet $iconSnippet,
            UriBuilder $uriBuilder,
            PostAttachmentSnippet $postAttachmentSnippet,
            IconButtonSnippet $iconButtonSnippet
        )
        {
            $this->iconSnippet = $iconSnippet;
            $this->uriBuilder = $uriBuilder;
            $this->postAttachmentSnippet = $postAttachmentSnippet;
            $this->iconButtonSnippet = $iconButtonSnippet;
        }


        public function render(Dom\Document $template, array $post, array $feed = []): Dom\Element
        {
            $cardClass = 'post-card';

            if (isset($post['is_checked']) && $post['is_checked']) {
                $cardClass = 'post-card -done';
            }

            $card = $template->createElement('article');
            $card->setClassName($cardClass);

            if (isset($post['archived']) && $post['archived']) {
                $banner = $template->createElement('div');
                $banner->setClassName('banner');
                $banner->appendText('This post is archived. It will be deleted ');
                $card->appendChild($banner);

                $deleteTime = $template->createElement('relative-time');
                $deleteTime->setAttribute('datetime', gmdate('c', $post['meta']['delete_timestamp']));
                $deleteTime->appendText(date('d.m.Y H:i:s', $post['meta']['delete_timestamp']));
                $banner->appendChild($deleteTime);

                $banner->appendText('.');
            }

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
                $buttons->appendChild($this->renderDeleteButton($template, $post));
                $buttons->appendChild($this->renderEditButton($template, $post));
            }

            return $card;
        }

        private function renderDeleteButton(Dom\Document $template, array $post): Dom\Element
        {
            $buttonData = [
                'post_id' => $post['id']
            ];

            $icon = 'actions/delete';
            $label = 'Delete';
            $action = '/action/post/delete';

            if (isset($post['archived'])) {
                $icon = 'actions/revert';
                $label = 'Restore';
                $action = '/action/post/restore';
            }

            $button = $this->iconButtonSnippet->render($template, $icon, $label);

            $button->setAttribute('is', 'ajax-button');
            $button->setAttribute('post-uri', $action);
            $button->setAttribute('post-data', json_encode($buttonData));

            return $button;
        }

        private function renderEditButton(Dom\Document $template, array $post): Dom\Element
        {
            $button = $this->iconButtonSnippet->render($template, 'actions/post', 'Edit', '', false);

            $button->setAttribute('href', $this->uriBuilder->buildEditPostPageUri($post['id']));

            return $button;
        }
    }
}
