<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\{
        Document, Element
    };
    use Timetabio\Frontend\ValueObjects\Feed;
    use Timetabio\Library\Locators\UserRoleLocator;
    use Timetabio\Library\UserRoles\Owner;
    use Timetabio\Library\ValueObjects\DisplayName;

    class FeedInvitationCardSnippet
    {
        /**
         * @var IconButtonSnippet
         */
        private $iconButtonSnippet;

        /**
         * @var AjaxButtonSnippet
         */
        private $ajaxButtonSnippet;

        /**
         * @var UserRoleLocator
         */
        private $userRoleLocator;

        public function __construct(IconButtonSnippet $iconButtonSnippet, AjaxButtonSnippet $ajaxButtonSnippet, UserRoleLocator $userRoleLocator)
        {
            $this->iconButtonSnippet = $iconButtonSnippet;
            $this->ajaxButtonSnippet = $ajaxButtonSnippet;
            $this->userRoleLocator = $userRoleLocator;
        }

        public function render(Document $document, array $invitation, Feed $feed): Element
        {
            $role = $this->userRoleLocator->locate($invitation['role']);

            $invitationItem = $document->createElement('li');
            $invitationItem->setClassName('user-list-item');

            $invitationName = $document->createElement('span');
            $invitationName->setClassName('name');
            $invitationName->appendText(new DisplayName($invitation['user']));
            $invitationItem->appendChild($invitationName);

            $invitationRole = $document->createElement('span');
            $invitationRole->setClassName('role light-pill');
            $invitationRole->appendText($role->getLabel());
            $invitationItem->appendChild($invitationRole);

            $invitationButton = $this->iconButtonSnippet->render($document, 'actions/delete', 'Delete');

            $this->ajaxButtonSnippet->render($invitationButton, '/action/feed/delete-invitation', [
                'feed_id' => $feed->getId(),
                'user_id' => $invitation['user']['id']
            ]);

            $invitationItem->appendChild($invitationButton);

            return $invitationItem;
        }
    }
}
