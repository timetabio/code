<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Handlers\Post\Survey
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Survey\Builders\UriBuilder;
    use Timetabio\Survey\Models\Action\SurveyActionModel;
    use Timetabio\Survey\Queries\FetchBetaRequestQuery;
    use Timetabio\Survey\Queries\FetchQuestionsQuery;
    use Timetabio\Survey\ValueObjects\AnswerValue;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchBetaRequestQuery
         */
        private $fetchBetaRequestQuery;

        /**
         * @var FetchQuestionsQuery
         */
        private $fetchQuestionsQuery;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(FetchBetaRequestQuery $fetchBetaRequestQuery, FetchQuestionsQuery $fetchQuestionsQuery, UriBuilder $uriBuilder)
        {
            $this->fetchBetaRequestQuery = $fetchBetaRequestQuery;
            $this->fetchQuestionsQuery = $fetchQuestionsQuery;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var SurveyActionModel $model */

            $betaRequestId = $model->getBetaRequest();
            $rawAnswers = $model->getRawAnswers();
            $betaRequest = $this->fetchBetaRequestQuery->execute($betaRequestId);

            if ($betaRequest === null || $betaRequest['survey_before_completed']) {
                throw new BadRequest('beta request not found');
            }

            $questions = $this->fetchQuestionsQuery->execute();

            foreach ($questions as $question) {
                $id = $question['id'];

                if (!isset($rawAnswers[$id])) {
                    throw new BadRequest('missing answer');
                }

                try {
                    $value = new AnswerValue($rawAnswers[$id]);
                } catch (\Exception $exception) {
                    throw new BadRequest('invalid answer value');
                }

                $model->addAnswer($id, $value->getValue());
            }

            $model->setData([
               'redirect' => $this->uriBuilder->buildSurveyThanksPage()
            ]);
        }
    }
}
