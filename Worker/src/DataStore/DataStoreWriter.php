<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\DataStore
{
    use Timetabio\Framework\Languages\LanguageInterface;
    use Timetabio\Library\DataObjects\StaticPage;
    use Timetabio\Library\DataStore\AbstractDataStoreWriter;

    class DataStoreWriter extends AbstractDataStoreWriter
    {
        public function removeStaticPages(LanguageInterface $language)
        {
            $this->getDataStore()->remove('static_pages_' . $language);
        }

        public function setStaticPage(string $name, LanguageInterface $language, StaticPage $staticPage)
        {
            $this->getDataStore()->setInHash('static_pages_' . $language, $name, serialize($staticPage));
        }

        public function removeStaticRoutes()
        {
            $this->getDataStore()->remove('static_routes');
        }

        public function setStaticRoute(string $route, string $staticPage)
        {
            $this->getDataStore()->setInHash('static_routes', $route, $staticPage);
        }

        /**
         * @deprecated
         */
        public function setPostBody(string $postId, string $body)
        {
            $this->getDataStore()->set('post_body:' . $postId, $body);
        }

        /**
         * @deprecated
         */
        public function setPostPreview(string $postId, string $body)
        {
            $this->getDataStore()->set('post_preview:' . $postId, $body);
        }

        public function setPostText(string $postId, string $body)
        {
            $this->getDataStore()->set('post_text:' . $postId, $body);
        }
    }
}
