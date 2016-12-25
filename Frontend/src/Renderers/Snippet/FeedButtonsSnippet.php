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

    class FeedButtonsSnippet implements TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FloatingButtonSnippet
         */
        private $floatingButtonSnippet;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(FloatingButtonSnippet $floatingButtonSnippet, UriBuilder $uriBuilder)
        {
            $this->floatingButtonSnippet = $floatingButtonSnippet;
            $this->uriBuilder = $uriBuilder;
        }

        public function render(Dom\Document $document, string $feedId): Dom\Element
        {
            $newPostUri = $this->uriBuilder->buildNewPostPageUri($feedId);

            $navElement = $document->createElement('nav');
            $navElement->setClassName('floating-buttons');

            $navElement->appendChild(
                $this->renderButton($document, 'note', $newPostUri, 'Note')
            );

            $navElement->appendChild(
                $this->renderButton($document, 'task', $newPostUri, 'Task')
            );

            $navElement->appendChild(
                $this->renderButton($document, 'event', $newPostUri, 'Event')
            );

            return $navElement;
        }

        private function renderButton(Dom\Document $document, string $icon, string $link, string $label): Dom\Element
        {
            return $this->floatingButtonSnippet->render(
                $document,
                $icon,
                $link,
                $this->getTranslator()->translate($label)
            );
        }
    }
}
