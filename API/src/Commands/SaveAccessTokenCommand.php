<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\ValueObjects\AccessToken;

    class SaveAccessTokenCommand
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(AccessToken $accessToken)
        {
            $this->dataStoreWriter->saveAccessToken($accessToken);
        }
    }
}
