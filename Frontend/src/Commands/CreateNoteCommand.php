<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class CreateNoteCommand
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $feedId, string $title, string $body, array $attachments): array
        {
            return $this->apiGateway->createNote($feedId, $title, $body, $attachments)->unwrap();
        }
    }
}
