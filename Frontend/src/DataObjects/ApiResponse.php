<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\DataObjects
{
    use Timetabio\Framework\Curl\Response;
    use Timetabio\Frontend\Exceptions\ApiException;

    class ApiResponse
    {
        /**
         * @var Response
         */
        private $response;

        public function __construct(Response $response)
        {
            $this->response = $response;
        }

        /**
         * @throws ApiException
         */
        public function unwrap()
        {
            $code = $this->response->getCode();
            $data = $this->response->getJsonDecodedBody();

            if ($code === 404) {
                return null;
            }

            if ($code >= 400 && $code < 600) {
                throw new ApiException($data['error']);
            }

            return $data;
        }
    }
}
