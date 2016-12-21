<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\Framework\ValueObjects\EmailPerson;
    use Timetabio\Framework\ValueObjects\Token;
    use Timetabio\Library\Tasks\SendVerificationEmailTask;

    class SendVerificationCommand
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(EmailPerson $person, Token $token)
        {
            $this->dataStoreWriter->queueTask(new SendVerificationEmailTask($person, $token));
        }
    }
}
