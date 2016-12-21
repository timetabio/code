<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    class CreateBetaRequestCommand extends AbstractApiCommand
    {
        public function execute(string $email): array
        {
            return $this->getApiGateway()->createBetaRequest($email)->unwrap();
        }
    }
}
