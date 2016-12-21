<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class TitleTransformation implements TransformationInterface
    {
        public function apply(PageModel $model, Document $template)
        {
            $template
                ->queryOne('/html/head/title')
                ->appendText($model->getTitle() . ' · timetab.io');
        }
    }
}
