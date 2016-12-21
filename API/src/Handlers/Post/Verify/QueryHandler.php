<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Verify
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Verify\VerifyModel;
    use Timetabio\API\Queries\User\FetchVerificationTokenQuery;
    use Timetabio\API\ValueObjects\UserId;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchVerificationTokenQuery
         */
        private $fetchUserByTokenQuery;

        public function __construct(FetchVerificationTokenQuery $fetchUserByTokenQuery)
        {
            $this->fetchUserByTokenQuery = $fetchUserByTokenQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var VerifyModel $model */
            /** @var PostRequest $request */

            $token = $this->fetchUserByTokenQuery->execute($model->getToken());

            if ($token === null) {
                throw new BadRequest('token does not exist', 'invalid_token');
            }

            $model->setAuthUserId(new UserId($token['user_id']));
        }
    }
}
