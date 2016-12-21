<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Handlers\Post\Survey
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Survey\Models\Action\SurveyActionModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var SurveyActionModel $model */

            try {
                $model->setRawAnswers($request->getParam('answers'));
                $model->setBetaRequest($request->getParam('beta_request'));
            } catch (\Exception $exception) {
                throw new BadRequest('missing or invalid parameters');
            }
        }
    }
}
