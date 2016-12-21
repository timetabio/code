<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Verify
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Verify\VerifyModel;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\Token;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var VerifyModel $model */

            if (!$request->hasParam('token')) {
                throw new BadRequest('missing parameter \'token\'', 'missing_parameter');
            }

            $model->setToken(new Token($request->getParam('token')));
        }
    }
}
