<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class RendererFactory extends AbstractChildFactory
    {
        public function createTranslateTransformation(): \Timetabio\Worker\Transformations\TranslateTransformation
        {
            return new \Timetabio\Worker\Transformations\TranslateTransformation(
                $this->getMasterFactory()->createGettext()
            );
        }

        public function createStaticPageRenderer(): \Timetabio\Worker\Renderers\StaticPageRenderer
        {
            return new \Timetabio\Worker\Renderers\StaticPageRenderer(
                $this->getMasterFactory()->createDomBackend(),
                $this->getMasterFactory()->createTranslateTransformation()
            );
        }
    }
}
