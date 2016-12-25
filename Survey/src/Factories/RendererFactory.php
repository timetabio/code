<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class RendererFactory extends AbstractChildFactory
    {
        public function createSurveyPageRenderer(): \Timetabio\Frontend\Renderers\PageRenderer
        {
            return new \Timetabio\Frontend\Renderers\PageRenderer(
                $this->getTemplate(),
                $this->getMasterFactory()->createSurveyPageContentRenderer(),
                $this->getMasterFactory()->createTransformer()
            );
        }

        public function createSurveyPageContentRenderer(): \Timetabio\Survey\Renderers\PageContent\SurveyPageContentRenderer
        {
            return new \Timetabio\Survey\Renderers\PageContent\SurveyPageContentRenderer;
        }

        private function getTemplate(): \Timetabio\Framework\Dom\Document
        {
            return $this->getMasterFactory()->createDomBackend()->loadHtml(
                'templates://template.html'
            );
        }
    }
}
