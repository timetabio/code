<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post
{
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\ActionModel;

    class TransformationHandler implements TransformationHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function execute(AbstractModel $model): string
        {
            /** @var ActionModel $model */

            $data = $model->getData();

            if (isset($data['error'])) {
                $data['error'] = $this->getTranslator()->translate($data['error']);
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}
