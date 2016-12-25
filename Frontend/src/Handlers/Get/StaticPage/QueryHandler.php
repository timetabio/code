<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\StaticPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\StaticPageModel;
    use Timetabio\Frontend\Queries\FetchStaticPageQuery;

    class QueryHandler implements QueryHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FetchStaticPageQuery
         */
        private $fetchStaticPageQuery;

        public function __construct(FetchStaticPageQuery $fetchStaticPageQuery)
        {
            $this->fetchStaticPageQuery = $fetchStaticPageQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var StaticPageModel $model */

            $staticPage = $this->fetchStaticPageQuery->execute(
                $model->getName(),
                $model->getLanguage()
            );

            if ($staticPage->hasCode()) {
                $model->setStatusCode($staticPage->getCode());
            }

            $title = $this->getTranslator()->translate($staticPage->getTitle());

            $model->setTitle($title);
            $model->setStaticPage($staticPage);
        }
    }
}
