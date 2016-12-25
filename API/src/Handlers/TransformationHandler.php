<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class TransformationHandler implements TransformationHandlerInterface
    {
        public function execute(AbstractModel $model): string
        {
            /** @var APIModel $model */

            return json_encode($model->getData(), JSON_PRETTY_PRINT) . PHP_EOL;
        }
    }
}
