<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\CreatePostPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\CreatePostPageModel;

    class QueryHandler implements QueryHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        public function execute(AbstractModel $model)
        {
            /** @var CreatePostPageModel $model */

            $model->setTitle($this->getTranslator()->translate('Create New Post'));
        }
    }
}
