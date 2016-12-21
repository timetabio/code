<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    use Timetabio\Library\DataObjects\FeedInvitation;

    class SendFeedInvitationTask implements TaskInterface
    {
        /**
         * @var FeedInvitation
         */
        private $invitation;

        public function __construct(FeedInvitation $invitation)
        {
            $this->invitation = $invitation;
        }

        public function getInvitation(): FeedInvitation
        {
            return $this->invitation;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\High;
        }
    }
}
