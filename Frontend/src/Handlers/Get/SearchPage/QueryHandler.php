<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\SearchPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Locators\SearchTabLocator;
    use Timetabio\Frontend\Models\Page\SearchPageModel;
    use Timetabio\Frontend\Queries\SearchQuery;

    class QueryHandler implements QueryHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var SearchQuery
         */
        private $searchQuery;

        /**
         * @var SearchTabLocator
         */
        private $searchTabLocator;

        public function __construct(SearchQuery $searchQuery, SearchTabLocator $searchTabLocator)
        {
            $this->searchQuery = $searchQuery;
            $this->searchTabLocator = $searchTabLocator;
        }

        public function execute(AbstractModel $model)
        {
            /** @var SearchPageModel $model */

            $searchType = $model->getSearchType();

            $model->setTitle($this->getTranslator()->translate('Search'));

            $model->setSearchResults(
                $this->searchQuery->execute(
                    $model->getSearchQuery(),
                    $searchType
                )
            );

            $model->setActiveTab(
                $this->searchTabLocator->locate($searchType)
            );
        }
    }
}
