<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Fragment
{
    use Timetabio\Framework\Dom;
    use Timetabio\Frontend\Models\Fragment\HomepagePostsFragmentModel;
    use Timetabio\Frontend\Models\FragmentModel;
    use Timetabio\Frontend\Renderers\Snippet\PostSnippet;

    class HomepagePostsFragmentRenderer implements FragmentRenderer
    {
        /**
         * @var PostSnippet
         */
        private $postSnippet;

        public function __construct(PostSnippet $postSnippet)
        {
            $this->postSnippet = $postSnippet;
        }

        public function render(FragmentModel $model): string
        {
            /** @var HomepagePostsFragmentModel $model */

            $document = new Dom\Document;
            $fragment = $document->createDocumentFragment();

            foreach ($model->getPosts() as $post) {
                $fragment->appendChild(
                    $this->postSnippet->render($document, $post, $post['feed'])
                );
            }

            return $document->saveHTML($fragment);
        }
    }
}
