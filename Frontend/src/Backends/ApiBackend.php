<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Backends
{
    use Timetabio\Framework\Curl\Credentials\CredentialsInterface;
    use Timetabio\Framework\Curl\Curl;
    use Timetabio\Framework\ValueObjects\Uri;
    use Timetabio\Frontend\DataObjects\ApiResponse;

    class ApiBackend
    {
        /**
         * @var Curl
         */
        private $curl;

        /**
         * @var string
         */
        private $apiUrl;

        public function __construct(Curl $curl, string $apiUrl)
        {
            $this->curl = $curl;
            $this->apiUrl = $apiUrl;
        }

        public function post(string $endpoint, array $params, CredentialsInterface $credentials = null): ApiResponse
        {
            return new ApiResponse($this->curl->post($this->buildUrl($endpoint), $params, $credentials));
        }

        public function patch(string $endpoint, array $params, CredentialsInterface $credentials = null): ApiResponse
        {
            return new ApiResponse($this->curl->patch($this->buildUrl($endpoint), $params, $credentials));
        }

        public function get(string $endpoint, array $params, CredentialsInterface $credentials = null): ApiResponse
        {
            return new ApiResponse($this->curl->get($this->buildUrl($endpoint, $params), $credentials));
        }

        public function delete(string $endpoint, array $params, CredentialsInterface $credentials = null): ApiResponse
        {
            return new ApiResponse($this->curl->delete($this->buildUrl($endpoint, $params), $credentials));
        }

        private function buildUrl(string $endpoint, array $params = []): Uri
        {
            $query = '';

            if (!empty($params)) {
                $query = '?' . http_build_query($params);
            }

            return new Uri($this->apiUrl . $endpoint . $query);
        }
    }
}
