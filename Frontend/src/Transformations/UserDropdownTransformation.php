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
                $query = '?' . http_build_query(['next' => $path]);
            }

            $link->setClassName('basic-link');
            $link->setAttribute('href', '/login' . $query);
            $link->appendText('Sign In');

            return $link;
        }

        private function renderUserDropdown(PageModel $model, Document $template)
        {
            $userMenu = $template->createElement('user-menu');
            $userMenu->setClassName('user-menu');

            $userMenuButton = $template->createElement('button');
            $userMenuButton->setClassName('button');
            $userMenuButton->setAttribute('is', 'user-menu-button');
            $userMenu->appendChild($userMenuButton);

            $userAvatar = $template->createElement('span');
            $userAvatar->setClassName('user-avatar');
            $userAvatar->appendText($model->getUser()->getUserAvatar());
            $userMenuButton->appendChild($userAvatar);

            $userNav = $template->createElement('nav');
            $userNav->setClassName('nav');
            $userMenu->appendChild($userNav);

            $postsPageLink = $template->createElement('a');
            $postsPageLink->setClassName('user-menu-link');
            $postsPageLink->setAttribute('href', '/');
            $postsPageLink->appendText('Posts');
            $userNav->appendChild($postsPageLink);

            $feedsPageLink = $template->createElement('a');
            $feedsPageLink->setClassName('user-menu-link');
            $feedsPageLink->setAttribute('href', '/feeds');
            $feedsPageLink->appendText('Feeds');
            $userNav->appendChild($feedsPageLink);

            $logoutButton = $template->createElement('button');
            $logoutButton->setClassName('user-menu-link');
            $logoutButton->setAttribute('is', 'ajax-button');
            $logoutButton->setAttribute('post-uri', '/action/logout');
            $logoutButton->appendText('Sign Out');
            $userNav->appendChild($logoutButton);

            return $userMenu;
        }
    }
}
