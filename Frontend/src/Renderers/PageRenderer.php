<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;
    use Timetabio\Frontend\Transformations\Transformer;

    class PageRenderer implements Renderer
    {
        /**
         * @var Document
         */
        private $template;

        /**
         * @var PageRendererInterface
         */
        private $pageRenderer;

        /**
         * @var Transformer
         */
        private $transformer;

        public function __construct(
            Document $template,
            PageRendererInterface $pageRenderer,
            Transformer $transformer
        )
        {
            $this->template = $template;
            $this->pageRenderer = $pageRenderer;
            $this->transformer = $transformer;
        }

        public function render(AbstractModel $model): string
        {
            /** @var PageModel $model */

            $this->pageRenderer->render($model, $this->template);
            $this->transformer->apply($model, $this->template);

            return $this->template->saveHTML();
        }

        protected function getTemplate(): Document
        {
            return $this->template;
        }
    }
}
