<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Handlers\Get\SurveyPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Survey\Models\Page\SurveyPageModel;
    use Timetabio\Survey\Queries\FetchQuestionsQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchQuestionsQuery
         */
        private $fetchQuestionsQuery;

        public function __construct(FetchQuestionsQuery $fetchQuestionsQuery)
        {
            $this->fetchQuestionsQuery = $fetchQuestionsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var SurveyPageModel $model */

            $model->setTitle('Survey');
            $model->setQuestions($this->fetchQuestionsQuery->execute());
        }
    }
}
