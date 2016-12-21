<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
