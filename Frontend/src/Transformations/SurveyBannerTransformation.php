<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

namespace Timetabio\Frontend\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\DataStore\DataStoreReader;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class SurveyBannerTransformation implements TransformationInterface
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function apply(PageModel $model, Document $template)
        {
            if (!$model->hasUser()) {
                return;
            }

            $headerElement = $template->queryOne('//header[@class="page-header"]');

            if ($headerElement === null) {
                return;
            }

            if ($this->dataStoreReader->hasSurveyCompleted('post', $model->getUser()->getEmail())) {
                return;
            }

            $banner = $template->createElement('a');
            $banner->setAttribute('href', 'https://survey.timetab.io/post/' . urlencode($model->getUser()->getUserId()));
            $banner->setClassName('page-banner');
            $banner->appendText('Hey there. Please take a moment to fill out our 2nd survey. Click this banner to fill out.');

            $headerElement->parentNode->insertBefore($banner, $headerElement);
        }
    }
}
