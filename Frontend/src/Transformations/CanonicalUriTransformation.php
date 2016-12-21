<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class CanonicalUriTransformation implements TransformationInterface
    {
        public function apply(PageModel $model, Document $template)
        {
            if (!$model->hasCanonicalUri()) {
                return;
            }

            $canonicalTag = $template->createElement('link');
            $canonicalTag->setAttribute('rel', 'canonical');
            $canonicalTag->setAttribute('href', $model->getCanonicalUri());

            $template->queryOne('//head')->appendChild($canonicalTag);
        }
    }
}
