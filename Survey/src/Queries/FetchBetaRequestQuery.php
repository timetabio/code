<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Queries
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FetchBetaRequestQuery
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(string $id)
        {
            return $this->databaseBackend->fetch(
                'SELECT * FROM beta_requests WHERE id = :id',
                [
                    'id' => $id
                ]
            );
        }
    }
}
