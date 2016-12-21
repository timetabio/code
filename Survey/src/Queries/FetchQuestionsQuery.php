<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Queries
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FetchQuestionsQuery
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT * FROM survey_questions'
            );
        }
    }
}
