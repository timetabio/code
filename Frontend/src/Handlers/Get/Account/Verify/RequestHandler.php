<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\Account\Verify
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Account\VerifyModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var VerifyModel $model */

            if (!$request->hasQueryParam('token')) {
                $model->setStatusCode(new \Timetabio\Framework\Http\StatusCodes\NotFound);
                return;
            }

            $model->setToken($request->getQueryParam('token'));
        }
    }
}
