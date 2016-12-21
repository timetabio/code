<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Frontend\Gateways\ApiGateway;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class SearchQuery
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $query, string $type): PaginatedResult
        {
            $data = $this->apiGateway->search($query, $type)->unwrap();

            return new PaginatedResult($data);
        }
    }
}
