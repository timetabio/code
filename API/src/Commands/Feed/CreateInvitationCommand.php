<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\Library\DataObjects\FeedInvitation;
    use Timetabio\Library\Services\FeedInvitationService;

    class CreateInvitationCommand
    {
        /**
         * @var FeedInvitationService
         */
        private $invitationService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(FeedInvitationService $invitationService, DataStoreWriter $dataStoreWriter)
        {
            $this->invitationService = $invitationService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(FeedInvitation $invitation): array
        {
            $result = $this->invitationService->createInvitation($invitation);

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\SendFeedInvitationTask($invitation));

            return $result;
        }
    }
}
