<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;
    use Timetabio\Framework\Http\Response\HtmlResponse;

    class ControllerFactory extends AbstractChildFactory
    {
        public function createSurveyPageController(array $survey): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Survey\Models\Page\SurveyPageModel($survey),
                $this->getMasterFactory()->createGetPagePreHandler(),
                $this->getMasterFactory()->createRequestHandler(),
                $this->getMasterFactory()->createSurveyPageQueryHandler(),
                $this->getMasterFactory()->createCommandHandler(),
                $this->getMasterFactory()->createSurveyPageTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

        public function createSurveyActionController(): \Timetabio\Framework\Controllers\PostController
        {
            return new \Timetabio\Framework\Controllers\PostController(
                new \Timetabio\Survey\Models\Action\SurveyActionModel,
                $this->getMasterFactory()->createPostPreHandler(),
                $this->getMasterFactory()->createSurveyActionRequestHandler(),
                $this->getMasterFactory()->createSurveyActionQueryHandler(),
                $this->getMasterFactory()->createSurveyActionCommandHandler(),
                $this->getMasterFactory()->createPostTransformationHandler(),
                $this->getMasterFactory()->createResponseHandler(),
                $this->getMasterFactory()->createPostHandler(),
                new HtmlResponse
            );
        }

    }
}
