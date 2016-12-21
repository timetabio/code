<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ServiceFactory extends AbstractChildFactory
    {
        public function createFeedInvitationService(): \Timetabio\Library\Services\FeedInvitationService
        {
            return new \Timetabio\Library\Services\FeedInvitationService(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }
    }
}
