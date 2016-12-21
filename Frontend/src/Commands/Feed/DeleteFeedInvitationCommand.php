<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands\Feed
{
    use Timetabio\Frontend\Commands\AbstractApiCommand;

    class DeleteFeedInvitationCommand extends AbstractApiCommand
    {
        public function execute(string $feedId, string $userId)
        {
            return $this->getApiGateway()->deleteFeedInvitation($feedId, $userId)->unwrap();
        }
    }
}
