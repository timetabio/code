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

    class Transformer implements TransformationInterface
    {
        /**
         * @var TransformationInterface[]
         */
        private $transformations;

        public function __construct(TransformationInterface ...$transformations)
        {
            $this->transformations = $transformations;
        }

        public function apply(PageModel $model, Document $template)
        {
            foreach ($this->transformations as $transformation) {
                $transformation->apply($model, $template);
            }
        }
    }
}
