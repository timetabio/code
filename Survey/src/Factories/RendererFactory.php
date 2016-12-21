<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
