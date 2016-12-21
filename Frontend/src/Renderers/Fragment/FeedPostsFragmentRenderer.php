<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Fragment
{
    use Timetabio\Framework\Dom;
    use Timetabio\Frontend\Models\Fragment\FeedPostsFragmentModel;
    use Timetabio\Frontend\Models\FragmentModel;
    use Timetabio\Frontend\Renderers\Snippet\PostSnippet;

    class FeedPostsFragmentRenderer implements FragmentRenderer
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
            /** @var FeedPostsFragmentModel $model */

            $document = new Dom\Document;
            $fragment = $document->createDocumentFragment();

            $feed = $model->getFeed();

            foreach ($model->getPosts() as $post) {
                $post['rendered_body'] = $post['preview'];

                $fragment->appendChild(
                    $this->postSnippet->render($document, $post, $feed)
                );
            }

            return $document->saveHTML($fragment);
        }
    }
}
