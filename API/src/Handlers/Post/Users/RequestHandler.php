<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Users
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\User\CreateModel;
    use Timetabio\API\ValueObjects\Password;
    use Timetabio\API\ValueObjects\Username;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var CreateModel $model */

            try {
                $email = new EmailAddress($request->getParam('email'));
            } catch (\Exception $e) {
                throw new BadRequest('invalid email address', 'invalid_email');
            }

            try {
                $password = new Password($request->getParam('password'));
            } catch (\Exception $e) {
                throw new BadRequest('password must be between 8 and 72 characters', 'invalid_password');
            }

            try {
                $username = new Username($request->getParam('username'));
            } catch (\Exception $e) {
                throw new BadRequest('invalid username', 'invalid_username');
            }

            $model->setEmail($email);
            $model->setPassword($password);
            $model->setUsername($username);
        }
    }
}
