<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
