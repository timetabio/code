<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Handlers\Get\SurveyPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Survey\Models\Page\SurveyPageModel;
    use Timetabio\Survey\Queries\FetchQuestionsQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchQuestionsQuery
         */
        private $fetchQuestionsQuery;

        public function __construct(FetchQuestionsQuery $fetchQuestionsQuery)
        {
            $this->fetchQuestionsQuery = $fetchQuestionsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var SurveyPageModel $model */

            $model->setTitle('Survey');
            $model->setQuestions($this->fetchQuestionsQuery->execute());
        }
    }
}
