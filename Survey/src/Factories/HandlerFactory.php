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

    class HandlerFactory extends AbstractChildFactory
    {
        public function createSurveyPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createSurveyPageRenderer()
            );
        }

        public function createSurveyPageQueryHandler(): \Timetabio\Survey\Handlers\Get\SurveyPage\QueryHandler
        {
            return new \Timetabio\Survey\Handlers\Get\SurveyPage\QueryHandler(
                $this->getMasterFactory()->createFetchQuestionsQuery()
            );
        }

        public function createSurveyActionRequestHandler(): \Timetabio\Survey\Handlers\Post\Survey\RequestHandler
        {
            return new \Timetabio\Survey\Handlers\Post\Survey\RequestHandler;
        }

        public function createSurveyActionQueryHandler(): \Timetabio\Survey\Handlers\Post\Survey\QueryHandler
        {
            return new \Timetabio\Survey\Handlers\Post\Survey\QueryHandler(
                $this->getMasterFactory()->createFetchBetaRequestQuery(),
                $this->getMasterFactory()->createFetchQuestionsQuery(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createSurveyActionCommandHandler(): \Timetabio\Survey\Handlers\Post\Survey\CommandHandler
        {
            return new \Timetabio\Survey\Handlers\Post\Survey\CommandHandler(
                $this->getMasterFactory()->createApproveBetaRequestCommand(),
                $this->getMasterFactory()->createInsertAnswerCommand(),
                $this->getMasterFactory()->createInsertCommentCommand(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }
    }
}
