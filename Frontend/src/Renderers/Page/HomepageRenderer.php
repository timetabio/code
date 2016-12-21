<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Page
{
    use Timetabio\Framework\Dom\{
        Document, Element
    };
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\HomepageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Snippet\HomepageNavigationSnippet;
    use Timetabio\Frontend\Renderers\Snippet\HomepageOnboardingSnippet;
    use Timetabio\Frontend\Renderers\Snippet\PaginationButtonSnippet;
    use Timetabio\Frontend\Renderers\Snippet\PostSnippet;

    class HomepageRenderer implements PageRendererInterface, TranslatorAwareInterface
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

        /**
         * @var HomepageNavigationSnippet
         */
        private $homepageNavigationSnippet;

        /**
         * @var HomepageOnboardingSnippet
         */
        private $homepageOnboardingSnippet;

        public function __construct(
            PostSnippet $postSnippet,
            PaginationButtonSnippet $paginationButtonSnippet,
            HomepageNavigationSnippet $homepageNavigationSnippet,
            HomepageOnboardingSnippet $homepageOnboardingSnippet
        )
        {
            $this->postSnippet = $postSnippet;
            $this->paginationButtonSnippet = $paginationButtonSnippet;
            $this->homepageNavigationSnippet = $homepageNavigationSnippet;
            $this->homepageOnboardingSnippet = $homepageOnboardingSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var HomepageModel $model */

            $posts = $model->getPosts();
            $main = $template->getMainElement();

            $main->appendChild($this->homepageNavigationSnippet->render($template, new \Timetabio\Frontend\Tabs\Homepage\Posts));

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding -no-padding-top');
            $main->appendChild($wrapper);

            if ($posts->getTotal() === 0) {
                $wrapper->appendChild($this->homepageOnboardingSnippet->render($template));
                return;
            }

            $listElement = $template->createElement('paginated-view');
            $listElement->setAttribute('endpoint-uri', '/fragment/homepage-posts');
            $listElement->setAttribute('total-pages', $posts->getPages());
            $wrapper->appendChild($listElement);

            $postsElement = $template->createElement('paginated-list');
            $postsElement->setClassName('post-list');
            $listElement->appendChild($postsElement);

            foreach ($posts as $post) {
                // TODO: this needs changing
                $post['rendered_body'] = $post['preview'];

                $postsElement->appendChild(
                    $this->postSnippet->render($template, $post, $post['feed'])
                );
            }

            $listElement->appendChild($this->paginationButtonSnippet->render($template, $posts));
        }
    }
}
