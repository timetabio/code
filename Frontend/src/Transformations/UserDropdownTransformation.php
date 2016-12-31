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
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Library\Transformations\TransformationInterface;

    // TODO: rename
    class UserDropdownTransformation implements TransformationInterface
    {
        public function apply(PageModel $model, Document $template)
        {
            /** @var Element $header */
            $headerRightDiv = $template->queryOne('//header[@class="page-header"]/div/div[3]');

            if ($headerRightDiv === null) {
                return;
            }

            if ($model->hasUser()) {
                $headerRightDiv->appendChild($this->renderUserDropdown($model, $template));
            } else {
                $headerRightDiv->appendChild($this->renderLoginLink($model, $template));
            }
        }

        private function renderLoginLink(PageModel $model, Document $template)
        {
            $link = $template->createElement('a');

            $path = $model->getUri()->getPath();
            $query = '';

            if ($path !== '/') {
                $query = http_build_query(['next' => $path]);
            }

            $link->setClassName('basic-link');
            $link->setAttribute('href', '/login' . $query);
            $link->appendText('Login');

            return $link;
        }

        private function renderUserDropdown(PageModel $model, Document $template)
        {
            $username = $template->createElement('span');

            $username->appendText($model->getUser()->getDisplayName());
            $username->setClassName('username right');

            return $username;
        }
    }
}
