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
    use Timetabio\Framework\Backends\DomBackend;
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class TrackingTransformation implements TransformationInterface
    {
        /**
         * @var DomBackend
         */
        private $domBackend;

        public function __construct(DomBackend $domBackend)
        {
            $this->domBackend = $domBackend;
        }

        public function apply(PageModel $model, Document $template)
        {
            if ($model->isTrackingDisabled()) {
                return;
            }

            $body = $template->queryOne('/html/body');
            $tracking = $this->domBackend->loadHtml('templates://content/tracking.html');

            $body->appendChild($template->importDocument($tracking));
        }
    }
}
