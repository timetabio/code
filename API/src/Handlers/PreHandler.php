<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers
{
    use Timetabio\API\DataStore\DataStoreReader;
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\Readers\RequestTokenReader;
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class PreHandler implements PreHandlerInterface
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        /**
         * @var RequestTokenReader
         */
        private $requestTokenReader;

        public function __construct(DataStoreReader $dataStoreReader, RequestTokenReader $requestTokenReader)
        {
            $this->dataStoreReader = $dataStoreReader;
            $this->requestTokenReader = $requestTokenReader;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var APIModel $model */

            $token = $this->requestTokenReader->read($request);

            if ($token === null) {
                return;
            }

            if (!$this->dataStoreReader->hasAccessToken($token)) {
                return;
            }

            $accessToken = $this->dataStoreReader->getAccessToken($token);

            $model->setAccessToken($accessToken);

            if ($accessToken->hasUserId()) {
                $model->setAuthUserId($accessToken->getUserId());
            }
        }
    }
}
