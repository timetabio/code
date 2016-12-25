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
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Models\PostPageModel;
    use Timetabio\Frontend\Renderers\Snippet\PostSnippet;

    class PostPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var PostSnippet
         */
        private $postSnippet;

        public function __construct(PostSnippet $postSnippet)
        {
            $this->postSnippet = $postSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var PostPageModel $model */

            $post = $model->getPost();
            $main = $template->getMainElement();

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding');

            $wrapper->appendChild(
                $this->postSnippet->render($template, $post, $post['feed'])
            );

            $main->appendChild($wrapper);
        }
    }
}
