<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed\Invitation
{
    use Timetabio\API\Models\Feed\FeedModel;

    class DeleteModel extends FeedModel
    {
        /**
         * @var string
         */
        private $userId;

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function setUserId(string $userId)
        {
            $this->userId = $userId;
        }
    }
}
