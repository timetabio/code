<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\PostHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class PostHandler implements PostHandlerInterface
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */

            if (!$model->hasAccessToken()) {
                return;
            }

            $accessToken = $model->getAccessToken();

            if (!$accessToken->getAutoRenew()) {
                return;
            }

            $this->dataStoreWriter->renewAccessToken($accessToken);
        }
    }
}
