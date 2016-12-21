<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Feed\User
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Feed\User\UpdateModel;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Locators\UserRoleLocator;

    class RequestHandler implements RequestHandlerInterface
    {
        /**
         * @var UserRoleLocator
         */
        private $userRoleLocator;

        public function __construct(UserRoleLocator $userRoleLocator)
        {
            $this->userRoleLocator = $userRoleLocator;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var UpdateModel $model */

            $parts = $request->getUri()->getExplodedPath();

            if (!$request->hasParam('role')) {
                throw new BadRequest('missing parameter \'role\'', 'missing_parameter');
            }

            try {
                $role = $this->userRoleLocator->locate($request->getParam('role'));
            } catch (\Exception $exception) {
                throw new BadRequest('invalid user role', 'invalid_role');
            }

            $model->setFeedId(new FeedId($parts[2]));
            $model->setUserId($parts[4]);
            $model->setRole($role);
        }
    }
}
