<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Renderers\Page\Feed
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\Page\FeedPeoplePageModel;
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Renderers\Page\PageRendererInterface;
    use Timetabio\Frontend\Renderers\Snippet\FeedInvitationCardSnippet;
    use Timetabio\Frontend\Renderers\Snippet\FeedUserCardSnippet;
    use Timetabio\Frontend\Renderers\Snippet\IconButtonSnippet;
    use Timetabio\Frontend\Renderers\Snippet\UserRolesOptionsSnippet;

    class FeedPeoplePageRenderer implements PageRendererInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var UserRolesOptionsSnippet
         */
        private $userRolesOptionsSnippet;

        /**
         * @var FeedUserCardSnippet
         */
        private $feedUserCardSnippet;

        /**
         * @var FeedInvitationCardSnippet
         */
        private $feedInvitationCardSnippet;

        /**
         * @var IconButtonSnippet
         */
        private $iconButtonSnippet;

        public function __construct(UserRolesOptionsSnippet $userRolesOptionsSnippet, FeedUserCardSnippet $feedUserCardSnippet, FeedInvitationCardSnippet $feedInvitationCardSnippet, IconButtonSnippet $iconButtonSnippet)
        {
            $this->userRolesOptionsSnippet = $userRolesOptionsSnippet;
            $this->feedUserCardSnippet = $feedUserCardSnippet;
            $this->feedInvitationCardSnippet = $feedInvitationCardSnippet;
            $this->iconButtonSnippet = $iconButtonSnippet;
        }

        public function render(PageModel $model, Document $template)
        {
            /** @var \Timetabio\Frontend\Models\Page\FeedPeoplePageModel $model */

            $feed = $model->getFeed();
            $main = $template->getMainElement();

            $wrapper = $template->createElement('div');
            $wrapper->setClassName('page-wrapper -padding');
            $main->appendChild($wrapper);

            if ($feed->hasUsersManageAccess()) {
                $wrapper->appendChild($this->renderInvitations($template, $model));
            }

            if (!$model->hasFeedUsers()) {
                return;
            }

            $usersTitle = $template->createElement('h2');
            $usersTitle->setClassName('basic-heading-b _margin-after-s');
            $usersTitle->appendText($this->getTranslator()->translate('Users'));
            $wrapper->appendChild($usersTitle);

            $usersList = $template->createElement('ul');
            $usersList->setClassName('user-list');
            $wrapper->appendChild($usersList);

            foreach ($model->getFeedUsers() as $user) {
                $usersList->appendChild($this->feedUserCardSnippet->render($template, $user, $feed));
            }
        }

        private function renderInvitations(Document $template, FeedPeoplePageModel $model)
        {
            $feed = $model->getFeed();
            $fragment = $template->createDocumentFragment();

            $invitationsTitle = $template->createElement('h2');
            $invitationsTitle->setClassName('basic-heading-b _margin-after-s');
            $invitationsTitle->appendText($this->getTranslator()->translate('Invitations'));
            $fragment->appendChild($invitationsTitle);

            $invitationForm = $template->createElement('form');
            $invitationForm->setClassName('user-list-item _margin-after-s');
            $invitationForm->setAttribute('is', 'ajax-form');
            $invitationForm->setAttribute('method', 'post');
            $invitationForm->setAttribute('action', '/action/feed/invite-user');
            $invitationForm->setAttribute('autocomplete', 'off');
            $fragment->appendChild($invitationForm);

            $invitationUsername = $template->createElement('input');
            $invitationUsername->setClassName('name');
            $invitationUsername->setAttribute('name', 'username');
            $invitationUsername->setAttribute('required', '');
            $invitationUsername->setAttribute('placeholder', 'peanut-butter');
            $invitationForm->appendChild($invitationUsername);

            $invitationRoleSelect = $template->createElement('select');
            $invitationRoleSelect->setClassName('role light-select');
            $invitationRoleSelect->setAttribute('name', 'role');
            $invitationRoleSelect->setAttribute('required', '');
            $invitationForm->appendChild($invitationRoleSelect);

            $invitationRoleSelect->appendChild($this->userRolesOptionsSnippet->render($template));

            $feedIdInput = $template->createElement('input');
            $feedIdInput->setAttribute('type', 'hidden');
            $feedIdInput->setAttribute('name', 'feed_id');
            $feedIdInput->setAttribute('value', $feed->getId());
            $invitationForm->appendChild($feedIdInput);

            $invitationButton = $this->iconButtonSnippet->render($template, 'actions/invite', 'Invite', '-color');
            $invitationButton->setAttribute('type', 'submit');
            $invitationButton->setAttribute('disabled', '');
            $invitationForm->appendChild($invitationButton);

            $invitationsList = $template->createElement('ul');
            $invitationsList->setClassName('user-list _margin-after-l');
            $fragment->appendChild($invitationsList);

            foreach ($model->getFeedInvitations() as $invitation) {
                $invitationsList->appendChild($this->feedInvitationCardSnippet->render($template, $invitation, $feed));
            }

            return $fragment;
        }
    }
}
