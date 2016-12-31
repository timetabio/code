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

    class NextUriTransformation implements TransformationInterface
    {
        public function apply(PageModel $model, Document $template)
        {
            if (!$model->hasNextUri()) {
                return;
            }

            $input = $template->queryOne('//input[@name="next_uri"]');

            if ($input === null) {
                return;
            }

            $input->setAttribute('value', $model->getNextUri());
        }
    }
}
