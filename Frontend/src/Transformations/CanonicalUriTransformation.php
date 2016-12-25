<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
