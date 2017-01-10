<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;
    use Timetabio\Framework\Http\Response\HtmlResponse;
    use Timetabio\Framework\Http\Response\JsonResponse;

    class ControllerFactory extends AbstractChildFactory
    {
        public function createSurveyPageController(array $survey, string $version): \Timetabio\Framework\Controllers\GetController
        {
            return new \Timetabio\Framework\Controllers\GetController(
                new \Timetabio\Survey\Models\Page\SurveyPageModel($survey, $version),
                $this->getMasterFactory()->createPreHandler(),
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
                new JsonResponse
            );
        }

    }
}
