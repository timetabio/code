<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Verify\Resend
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Verify\ResendModel;
    use Timetabio\API\Queries\User\FetchVerificationTokenByEmailQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\EmailPerson;
    use Timetabio\Framework\ValueObjects\Token;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchVerificationTokenByEmailQuery
         */
        private $fetchTokenQuery;

        public function __construct(FetchVerificationTokenByEmailQuery $fetchTokenQuery)
        {
            $this->fetchTokenQuery = $fetchTokenQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResendModel $model */

            $email = $model->getEmail();

            $token = $this->fetchTokenQuery->execute($email);

            if ($token === null) {
                throw new BadRequest('no token found for email', 'email_not_found');
            }

            $model->setEmailPerson(new EmailPerson($email));
            $model->setToken(new Token($token['token']));

            $model->setData([
                'id' => $token['user_id'],
                'verified' => false
            ]);
        }
    }
}
