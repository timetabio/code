<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class QueryFactory extends AbstractChildFactory
    {
        public function createFetchBetaRequestQuery(): \Timetabio\Survey\Queries\FetchBetaRequestQuery
        {
            return new \Timetabio\Survey\Queries\FetchBetaRequestQuery(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createFetchQuestionsQuery(): \Timetabio\Survey\Queries\FetchQuestionsQuery
        {
            return new \Timetabio\Survey\Queries\FetchQuestionsQuery(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }
    }
}
