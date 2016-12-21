<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Page
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\Page\FeedPostsPageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Snippet\PaginationButtonSnippet;
    use Timetabio\Frontend\Renderers\Snippet\PostSnippet;

    class FeedPageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var PostSnippet
         */
        private $postSnippet;

        /**
         * @var PaginationButtonSnippet
         */
        private $paginationButtonSnippet;

        public function __construct(PostSnippet $postSnippet, PaginationButtonSnippet $paginationButtonSnippet)
        {
            $this->postSnippet = $postSnippet;
            $this->paginationButtonSnippet = $paginationButtonSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var FeedPostsPageModel $model */

            $feed = $model->getFeed();
            $posts = $model->getFeedPosts();
            $main = $template->getMainElement();

            $wrapper = $template->createElement('paginated-view');
            $wrapper->setClassName('page-wrapper -padding');
            $wrapper->setAttribute('endpoint-uri', '/fragment/feed-posts/' . $feed->getId());
            $wrapper->setAttribute('total-pages', $posts->getPages());

            $main->appendChild($wrapper);

            $postsElement = $template->createElement('paginated-list');
            $postsElement->setClassName('post-list');

            $wrapper->appendChild($postsElement);

            foreach ($posts as $post) {
                $post['rendered_body'] = $post['preview'];

                $postsElement->appendChild(
                    $this->postSnippet->render($template, $post, $feed->toArray())
                );
            }

            $wrapper->appendChild($this->paginationButtonSnippet->render($template, $posts));
        }
    }
}
