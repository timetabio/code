<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\Fragment
{
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\FragmentModel;
    use Timetabio\Frontend\Renderers\Fragment\FragmentRenderer;

    /**
     * @deprecated Use Timetabio\Frontend\Handlers\Get\Page\TransformationHandler instead
     */
    class TransformationHandler implements TransformationHandlerInterface
    {
        /**
         * @var FragmentRenderer
         */
        private $fragmentRenderer;

        public function __construct(FragmentRenderer $fragmentRenderer)
        {
            $this->fragmentRenderer = $fragmentRenderer;
        }

        public function execute(AbstractModel $model): string
        {
            /** @var FragmentModel $model */

            return $this->fragmentRenderer->render($model);
        }
    }
}
