<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Models\Page
{
    use Timetabio\Frontend\Models\PageModel;

    class SurveyPageModel extends PageModel
    {
        /**
         * @var array
         */
        private $betaRequest;

        /**
         * @var array
         */
        private $questions;

        public function __construct(array $betaRequest)
        {
            $this->betaRequest = $betaRequest;
        }

        public function getBetaRequest(): array
        {
            return $this->betaRequest;
        }

        public function getQuestions(): array
        {
            return $this->questions;
        }

        public function setQuestions(array $questions)
        {
            $this->questions = $questions;
        }
    }
}
