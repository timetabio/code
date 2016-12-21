<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Renderers\Snippet
{
    use Timetabio\Framework\Dom\{
        Document, Element
    };
    use Timetabio\Frontend\ValueObjects\Feed;
    use Timetabio\Library\Locators\UserRoleLocator;
    use Timetabio\Library\ValueObjects\DisplayName;

    class FeedUserCardSnippet
    {
        /**
         * @var IconButtonSnippet
         */
        private $iconButtonSnippet;

        /**
         * @var UserRolesOptionsSnippet
         */
        private $userRolesOptionsSnippet;

        /**
         * @var AjaxButtonSnippet
         */
        private $ajaxButtonSnippet;

        /**
         * @var UserRoleLocator
         */
        private $userRoleLocator;

        public function __construct(IconButtonSnippet $iconButtonSnippet, UserRolesOptionsSnippet $userRolesOptionsSnippet, AjaxButtonSnippet $ajaxButtonSnippet, UserRoleLocator $userRoleLocator)
        {
            $this->iconButtonSnippet = $iconButtonSnippet;
            $this->userRolesOptionsSnippet = $userRolesOptionsSnippet;
            $this->ajaxButtonSnippet = $ajaxButtonSnippet;
            $this->userRoleLocator = $userRoleLocator;
        }

        public function render(Document $document, array $user, Feed $feed): Element
        {
            $userItem = $document->createElement('li');
            $userItem->setClassName('user-list-item');

            $userName = $document->createElement('span');
            $userName->setClassName('name');
            $userName->appendText(new DisplayName($user['user']));
            $userItem->appendChild($userName);

            $userItem->appendChild($this->renderRole($document, $user, $feed));

            if ($feed->hasUsersManageAccess()) {
                $userItem->appendChild($this->renderDeleteButton($document, $user, $feed));
            }

            return $userItem;
        }

        private function renderRole(Document $document, array $user, Feed $feed): Element
        {
            $role = $this->userRoleLocator->locate($user['role']);

            // TODO: change this condition ($role instanceof Owner)
            if (!$feed->hasUsersManageAccess() || !$user['meta']['is_modifiable']) {
                $pill = $document->createElement('span');

                $pill->setClassName('role light-pill');
                $pill->appendText($role->getLabel());

                return $pill;
            }

            $userRoleSelect = $document->createElement('select');
            $userRoleSelect->setAttribute('is', 'ajax-select');
            $userRoleSelect->setAttribute('post-uri', '/action/feed/update-user');
            $userRoleSelect->setAttribute('post-data', json_encode([
                'feed_id' => $feed->getId(),
                'user_id' => $user['user']['id']
            ]));
            $userRoleSelect->setClassName('role light-select');
            $userRoleSelect->setAttribute('name', 'role');
            $userRoleSelect->appendChild($this->userRolesOptionsSnippet->render($document, $user['role']));

            return $userRoleSelect;
        }

        private function renderDeleteButton(Document $document, array $user, Feed $feed): Element
        {
            $deleteButton = $this->iconButtonSnippet->render($document, 'actions/delete', 'Delete');

            $this->ajaxButtonSnippet->render($deleteButton, '/action/feed/delete-user', [
                'feed_id' => $feed->getId(),
                'user_id' => $user['user']['id']
            ]);

            if (!$user['meta']['is_modifiable']) {
                $deleteButton->setAttribute('disabled', '');
            }

            return $deleteButton;
        }
    }
}
