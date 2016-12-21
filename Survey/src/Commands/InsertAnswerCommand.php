<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Commands
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class InsertAnswerCommand
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(string $question, int $value, string $betaRequest)
        {
            return $this->databaseBackend->insert(
                'INSERT INTO survey_answers (value, survey_question_id, beta_request_id, version)
                 VALUES (:value, :survey_question_id, :beta_request_id, :version)',
                [
                    'value' => $value,
                    'survey_question_id' => $question,
                    'beta_request_id' => $betaRequest,
                    'version' => 'before'
                ]
            );
        }
    }
}
