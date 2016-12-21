<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Frontend\DataStore\DataStoreReader;
    use Timetabio\Library\DataObjects\StaticPage;

    class FetchStaticPageQuery
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(string $name, LanguageInterface $language): StaticPage
        {
            return $this->dataStoreReader->getStaticPage($name, $language);
        }
    }
}
