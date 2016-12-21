<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models
{
    use Timetabio\API\ValueObjects\AccessToken;
    use Timetabio\API\ValueObjects\UserId;
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class APIModel extends AbstractModel
    {
        /**
         * @var \JsonSerializable|array
         */
        private $data = [];

        /**
         * @var StatusCodeInterface
         */
        private $statusCode;

        /**
         * @var AccessToken
         */
        private $accessToken;

        /**
         * @var UserId
         */
        private $authUserId;

        /**
         * @return \JsonSerializable|array
         */
        public function getData()
        {
            return $this->data;
        }

        /**
         * @param \JsonSerializable|array $data
         */
        public function setData($data)
        {
            $this->data = $data;
        }

        public function hasStatusCode(): bool
        {
            return $this->statusCode !== null;
        }

        public function getStatusCode(): StatusCodeInterface
        {
            return $this->statusCode;
        }

        public function setStatusCode(StatusCodeInterface $statusCode)
        {
            $this->statusCode = $statusCode;
        }

        public function hasAccessToken(): bool
        {
            return $this->accessToken !== null;
        }

        public function getAccessToken(): AccessToken
        {
            return $this->accessToken;
        }

        public function setAccessToken(AccessToken $accessToken)
        {
            $this->accessToken = $accessToken;
        }

        public function hasAuthUserId(): bool
        {
            return $this->authUserId !== null;
        }

        public function getAuthUserId(): UserId
        {
            return $this->authUserId;
        }

        public function setAuthUserId(UserId $authUserId)
        {
            $this->authUserId = $authUserId;
        }
    }
}
