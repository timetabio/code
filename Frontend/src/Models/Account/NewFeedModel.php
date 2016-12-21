<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Account
{
    use Timetabio\Frontend\Models\ActionModel;

    class NewFeedModel extends ActionModel
    {
        /**
         * @var string
         */
        private $feedName;

        /**
         * @var string
         */
        private $feedDescription;

        /**
         * @var bool
         */
        private $feedIsPrivate;

        public function getFeedName(): string
        {
            return $this->feedName;
        }

        public function setFeedName(string $feedName)
        {
            $this->feedName = $feedName;
        }

        public function getFeedDescription(): string
        {
            return $this->feedDescription;
        }

        public function setFeedDescription(string $feedDescription)
        {
            $this->feedDescription = $feedDescription;
        }

        public function getFeedIsPrivate(): bool
        {
            return $this->feedIsPrivate;
        }

        public function setFeedIsPrivate(bool $feedIsPrivate)
        {
            $this->feedIsPrivate = $feedIsPrivate;
        }
    }
}
