<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Page
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;

    interface PageRendererInterface
    {
        public function render(PageModel $model, Document $template);
    }
}
