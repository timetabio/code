<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\Page
{
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Renderer;

    class TransformationHandler implements TransformationHandlerInterface
    {
        /**
         * @var Renderer
         */
        private $renderer;

        public function __construct(Renderer $renderer)
        {
            $this->renderer = $renderer;
        }

        public function execute(AbstractModel $model): string
        {
            /** @var PageModel $model */

            return $this->renderer->render($model);
        }
    }
}
