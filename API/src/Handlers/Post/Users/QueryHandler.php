<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Users
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\User\CreateModel;
    use Timetabio\API\Queries\User\FetchUserByEmailQuery;
    use Timetabio\API\Queries\User\FetchUserByUsernameQuery;
    use Timetabio\API\Queries\User\IsInvitedQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserByEmailQuery
         */
        private $fetchUserByEmailQuery;

        /**
         * @var FetchUserByUsernameQuery
         */
        private $fetchUserByUsernameQuery;

        /**
         * @var IsInvitedQuery
         */
        private $isInvitedQuery;

        public function __construct(
            FetchUserByEmailQuery $fetchUserByEmailQuery,
            FetchUserByUsernameQuery $fetchUserByUsernameQuery,
            IsInvitedQuery $isInvitedQuery
        )
        {
            $this->fetchUserByEmailQuery = $fetchUserByEmailQuery;
            $this->fetchUserByUsernameQuery = $fetchUserByUsernameQuery;
            $this->isInvitedQuery = $isInvitedQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $email = $model->getEmail();

            if (!$this->isInvitedQuery->execute($email)) {
                throw new BadRequest('email is not invited', 'email_not_invited');
            }

            $userByEmail = $this->fetchUserByEmailQuery->execute($email);

            if ($userByEmail !== null) {
                throw new BadRequest('email already registered', 'email_already_registered');
            }

            $userByUsername = $this->fetchUserByUsernameQuery->execute($model->getUsername());

            if ($userByUsername !== null) {
                throw new BadRequest('username already registered', 'username_taken');
            }
        }
    }
}
