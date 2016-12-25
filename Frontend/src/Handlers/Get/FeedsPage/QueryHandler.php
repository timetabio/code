<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\FeedsPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\FeedsPageModel;
    use Timetabio\Frontend\Queries\FetchUserFeedsQuery;

    class QueryHandler implements QueryHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FetchUserFeedsQuery
         */
        private $fetchUserFeedsQuery;

        public function __construct(FetchUserFeedsQuery $fetchUserFeedsQuery)
        {
            $this->fetchUserFeedsQuery = $fetchUserFeedsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedsPageModel $model */

            $model->setTitle($this->getTranslator()->translate('Feeds'));
            $model->setFeeds($this->fetchUserFeedsQuery->execute());
        }
    }
}
