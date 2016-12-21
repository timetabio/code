<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Mails
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Dom\Element;
    use Timetabio\Library\Builders\UriBuilder;
    use Timetabio\Library\UserRoles\UserRole;

    class FeedInvitationMail extends AbstractMail
    {
        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        /**
         * @var string
         */
        private $feedName;

        /**
         * @var string
         */
        private $feedId;

        /**
         * @var UserRole
         */
        private $role;

        public function __construct(Document $template, UriBuilder $uriBuilder)
        {
            parent::__construct($template);

            $this->uriBuilder = $uriBuilder;
        }

        public function setFeedName(string $feedName)
        {
            $this->feedName = $feedName;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }

        public function setRole(UserRole $role)
        {
            $this->role = $role;
        }

        public function getSubject(): string
        {
            return 'You have been invited to "' . $this->feedName . '"';
        }

        public function render(): string
        {
            $template = $this->getTemplate();
            $template->getXpath()->registerNamespace('xhtml', 'http://www.w3.org/1999/xhtml');

            $feedUri = $this->uriBuilder->buildFeedPageUri($this->feedId);

            $greeting = $template->queryOne('//*[@id="greeting"]');
            $greeting->appendText($this->getRecipient()->getName());

            $action = $template->queryOne('//*[@id="action"]');
            $action->appendText($this->getAction());

            $feedNames = $template->query('//*[@class="feed-name"]');

            /** @var Element $feedName */
            foreach ($feedNames as $feedName) {
                $feedName->appendText($this->feedName);
            }

            $button = $template->queryOne('//*[@id="button"]');
            $button->setAttribute('href', $feedUri);

            $link = $template->queryOne('//*[@id="link"]');
            $link->setAttribute('href', $feedUri);
            $link->appendText($feedUri);

            return $template->saveHTML();
        }

        private function getAction(): string
        {
            if ($this->role instanceof \Timetabio\Library\UserRoles\Moderator) {
                return 'moderate';
            }

            return 'add';
        }
    }
}
