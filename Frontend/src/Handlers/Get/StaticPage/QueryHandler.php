<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
