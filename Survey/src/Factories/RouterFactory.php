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

    class RouterFactory extends AbstractChildFactory
    {
        public function createBetaSurveyRouter(): \Timetabio\Survey\Routers\BetaSurveyRouter
        {
            return new \Timetabio\Survey\Routers\BetaSurveyRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createFetchBetaRequestQuery()
            );
        }

        public function createPostSurveyRouter(): \Timetabio\Survey\Routers\PostSurveyRouter
        {
            return new \Timetabio\Survey\Routers\PostSurveyRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createFetchBetaRequestQuery()
            );
        }

        public function createSurveyActionRouter(): \Timetabio\Survey\Routers\ActionRouter
        {
            return new \Timetabio\Survey\Routers\ActionRouter(
                $this->getMasterFactory()
            );
        }
    }
}
