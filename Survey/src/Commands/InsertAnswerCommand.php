<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
