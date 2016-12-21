<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\User
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\User\UpdateUserModel;
    use Timetabio\API\Queries\User\FetchUsernameQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUsernameQuery
         */
        private $fetchUsernameQuery;

        public function __construct(FetchUsernameQuery $fetchUsernameQuery)
        {
            $this->fetchUsernameQuery = $fetchUsernameQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateUserModel $model */

            if (!$model->hasUpdate('username')) {
                return;
            }

            $currentUsername = $this->fetchUsernameQuery->execute($model->getAuthUserId());
            $newUsername = $model->getUpdate('username');

            if (mb_strtolower($newUsername) !== mb_strtolower($currentUsername)) {
                throw new BadRequest('only case changes allowed for username', 'invalid_username');
            }
        }
    }
}
