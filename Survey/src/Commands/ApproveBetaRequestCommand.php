<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Commands
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class ApproveBetaRequestCommand
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(string $betaRequest)
        {
            $this->databaseBackend->execute(
                'UPDATE beta_requests
                 SET approved = TRUE, survey_before_completed = TRUE
                 WHERE id = :id',
                [
                    'id' => $betaRequest
                ]
            );
        }
    }
}
