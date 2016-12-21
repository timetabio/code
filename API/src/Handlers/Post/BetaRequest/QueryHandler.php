<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\BetaRequest
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\BetaRequest\CreateModel;
    use Timetabio\API\Queries\BetaRequest\FetchBetaRequestByEmailQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchBetaRequestByEmailQuery
         */
        private $fetchBetaRequestByEmailQuery;

        public function __construct(FetchBetaRequestByEmailQuery $fetchBetaRequestByEmailQuery)
        {
            $this->fetchBetaRequestByEmailQuery = $fetchBetaRequestByEmailQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            if ($this->fetchBetaRequestByEmailQuery->execute($model->getEmail())) {
                throw new BadRequest('email already added', 'email_already_added');
            }
        }
    }
}
