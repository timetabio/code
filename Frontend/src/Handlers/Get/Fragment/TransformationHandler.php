<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
