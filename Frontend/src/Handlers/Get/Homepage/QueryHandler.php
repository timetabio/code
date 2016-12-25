<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\Homepage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\HomepageModel;
    use Timetabio\Frontend\Queries\FetchUserFeedQuery;

    class QueryHandler implements QueryHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FetchUserFeedQuery
         */
        private $fetchUserFeedQuery;

        public function __construct(FetchUserFeedQuery $fetchUserFeedQuery)
        {
            $this->fetchUserFeedQuery = $fetchUserFeedQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var HomepageModel $model */

            $model->setTitle($this->getTranslator()->translate('Home'));
            $model->setPosts($this->fetchUserFeedQuery->execute());
        }
    }
}
