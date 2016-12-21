<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\DataStore
{
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Framework\Map\MapInterface;
    use Timetabio\Library\DataObjects\StaticPage;
    use Timetabio\Library\DataStore\AbstractDataStoreReader;

    class DataStoreReader extends AbstractDataStoreReader
    {
        public function getSystemToken(): string
        {
            return $this->getDataStore()->get('system_token');
        }

        public function hasSessionData(string $sessionId)
        {
            return $this->getDataStore()->has('session_data_' . $sessionId);
        }

        public function getSessionData(string $sessionId): MapInterface
        {
            return unserialize($this->getDataStore()->get('session_data_' . $sessionId));
        }

        public function getStaticPage(string $name, LanguageInterface $language): StaticPage
        {
            return unserialize($this->getDataStore()->getFromHash('static_pages_' . $language, $name));
        }

        public function hasRoute(string $path)
        {
            return $this->getDataStore()->hasInHash('static_routes', $path);
        }

        public function getRoute(string $path): string
        {
            return $this->getDataStore()->getFromHash('static_routes', $path);
        }
    }
}
