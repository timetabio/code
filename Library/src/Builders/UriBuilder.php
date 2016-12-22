<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Builders
{
    use Timetabio\Library\DataStore\AbstractDataStoreReader;

    class UriBuilder
    {
        /**
         * @var AbstractDataStoreReader
         */
        private $dataStoreReader;

        /**
         * @var string
         */
        private $uriHost;

        public function __construct(AbstractDataStoreReader $dataStoreReader, $uriHost)
        {
            $this->dataStoreReader = $dataStoreReader;
            $this->uriHost = $uriHost;
        }

        public function buildVerificationUri(string $token): string
        {
            return $this->uriHost . '/account/verify?' . http_build_query(['token' => $token]);
        }

        public function buildFeedPageUri(string $feedId): string
        {
            return $this->uriHost . '/feed/' . $this->getFeedUriPart($feedId);
        }

        public function buildNewPostPageUri(string $feedId): string
        {
            return $this->uriHost . '/feed/' . $this->getFeedUriPart($feedId) . '/note';
        }

        public function buildFeedPeoplePageUri(string $feedId): string
        {
            return $this->uriHost . '/feed/' . $this->getFeedUriPart($feedId) . '/people';
        }

        public function buildFeedSettingsPageUri(string $feedId): string
        {
            return $this->uriHost . '/feed/' . $this->getFeedUriPart($feedId) . '/settings';
        }

        public function buildPostPageUri(string $postId): string
        {
            return $this->uriHost . '/post/' . $postId;
        }

        public function buildSearchPageUri(string $query): string
        {
            return $this->uriHost . '/search?' . http_build_query(['q' => $query]);
        }

        public function buildFeedsSearchPageUri(string $query): string
        {
            return $this->uriHost . '/search/feeds?' . http_build_query(['q' => $query]);
        }

        public function buildPostsSearchPageUri(string $query): string
        {
            return $this->uriHost . '/search/posts?' . http_build_query(['q' => $query]);
        }

        public function buildFileUri(string $publicId, string $filename): string
        {
            // Just a heads up dear developer from the future.
            // DO NOT EVER EVEN think about changing `rawurlencode` to `urlencode`,
            // it will break the amazon signature thingy for files with spaces in their name.
            // This is due to the nature of `urlencode`, which encodes spaces as + instead of %20.
            return $publicId . '/' . rawurlencode($filename);
        }

        private function getFeedUriPart(string $feedId)
        {
            if ($this->dataStoreReader->hasFeedVanity($feedId)) {
                return urlencode($this->dataStoreReader->getFeedVanity($feedId));
            }

            return $feedId;
        }
    }
}
