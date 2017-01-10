<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class TransformationFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createTitleTransformation(): \Timetabio\Frontend\Transformations\TitleTransformation
        {
            return new \Timetabio\Frontend\Transformations\TitleTransformation;
        }

        public function createCsrfTokenTransformation(): \Timetabio\Frontend\Transformations\CsrfTokenTransformation
        {
            return new \Timetabio\Frontend\Transformations\CsrfTokenTransformation;
        }

        public function createUserDropdownTransformation(): \Timetabio\Frontend\Transformations\UserDropdownTransformation
        {
            return new \Timetabio\Frontend\Transformations\UserDropdownTransformation;
        }

        public function createTranslateTransformation(): \Timetabio\Library\Transformations\TranslateTransformation
        {
            return new \Timetabio\Library\Transformations\TranslateTransformation(
                $this->getMasterFactory()->createGettext()
            );
        }

        public function createCanonicalUriTransformation(): \Timetabio\Frontend\Transformations\CanonicalUriTransformation
        {
            return new \Timetabio\Frontend\Transformations\CanonicalUriTransformation;
        }

        public function createNextUriTransformation(): \Timetabio\Frontend\Transformations\NextUriTransformation
        {
            return new \Timetabio\Frontend\Transformations\NextUriTransformation;
        }

        public function createTrackingTransformation(): \Timetabio\Frontend\Transformations\TrackingTransformation
        {
            return new \Timetabio\Frontend\Transformations\TrackingTransformation(
                $this->getMasterFactory()->createDomBackend()
            );
        }

        public function createSurveyBannerTransformation(): \Timetabio\Frontend\Transformations\SurveyBannerTransformation
        {
            return new \Timetabio\Frontend\Transformations\SurveyBannerTransformation(
                $this->getMasterFactory()->createDomBackend()
            );
        }

        public function createTransformer(): \Timetabio\Frontend\Transformations\Transformer
        {
            $transformations = [
                $this->getMasterFactory()->createTitleTransformation(),
                $this->getMasterFactory()->createCsrfTokenTransformation(),
                $this->getMasterFactory()->createUserDropdownTransformation(),
                $this->getMasterFactory()->createTranslateTransformation(),
                $this->getMasterFactory()->createCanonicalUriTransformation(),
                $this->getMasterFactory()->createNextUriTransformation(),
                $this->getMasterFactory()->createSurveyBannerTransformation()
            ];

            if (!$this->getMasterFactory()->getConfiguration()->isDevelopmentMode()) {
                $transformations[] = $this->getMasterFactory()->createTrackingTransformation();
            }

            return new \Timetabio\Frontend\Transformations\Transformer(...$transformations);
        }
    }
}
