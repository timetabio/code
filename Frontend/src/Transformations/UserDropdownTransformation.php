<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Transformations
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    class UserDropdownTransformation implements TransformationInterface
    {
        public function apply(PageModel $model, Document $template)
        {
            if (!$model->hasUser()) {
                return;
            }

            $user = $model->getUser();
            $header = $template->queryOne('//header[@class="page-header"]/div');

            if ($header === null) {
                return;
            }

            $link = $header->queryOne('//a[2]');
            $link->parentNode->removeChild($link);

            $username = $template->createElement('span');
            $username->appendText($user->getDisplayName());
            $username->setClassName('username right');

            $header->appendChild($username);
        }
    }
}
