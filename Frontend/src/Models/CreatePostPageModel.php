<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    class CreatePostPageModel extends PageModel
    {
        /**
         * @var array
         */
        private $feedInfo;

        public function __construct(array $feedInfo)
        {
            $this->feedInfo = $feedInfo;
        }

        public function getFeedInfo(): array
        {
            return $this->feedInfo;
        }
    }
}
