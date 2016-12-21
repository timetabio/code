<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands\Feed
{
    use Timetabio\Frontend\Commands\AbstractApiCommand;

    class UpdateFeedUserRoleCommand extends AbstractApiCommand
    {
        public function execute(string $feedId, string $userId, string $role)
        {
            return $this->getApiGateway()->updateFeedUser($feedId, $userId, $role)->unwrap();
        }
    }
}
