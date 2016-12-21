<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class CsrfTokenTransformation implements TransformationInterface
    {
        public function apply(PageModel $model, Document $template)
        {
            $metaElement = $template->queryOne('/html/head/meta[@name="csrf-token"]');
            $metaElement->setAttribute('content', $model->getCrfsToken());
        }
    }
}
