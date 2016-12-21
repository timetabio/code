<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Tabs\Tab;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;
    use Timetabio\Library\SearchTypes\SearchType;

    class SearchPageModel extends PageModel
    {
        /**
         * @var SearchType
         */
        private $searchType;

        /**
         * @var string
         */
        private $searchQuery = '';

        /**
         * @var PaginatedResult
         */
        private $searchResults;

        /**
         * @var Tab
         */
        private $activeTab;

        public function __construct(SearchType $searchType)
        {
            $this->searchType = $searchType;
        }

        public function getSearchType(): SearchType
        {
            return $this->searchType;
        }

        public function getSearchQuery(): string
        {
            return $this->searchQuery;
        }

        public function setSearchQuery(string $searchQuery)
        {
            $this->searchQuery = $searchQuery;
        }

        public function getSearchResults(): PaginatedResult
        {
            return $this->searchResults;
        }

        public function setSearchResults(PaginatedResult $searchResults)
        {
            $this->searchResults = $searchResults;
        }

        public function getActiveTab(): Tab
        {
            return $this->activeTab;
        }

        public function setActiveTab(Tab $activeTab)
        {
            $this->activeTab = $activeTab;
        }
    }
}
