<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed\People
{
    use Timetabio\API\Models\Feed\FeedModel;
    use Timetabio\API\ValueObjects\UserId;

    class DeleteModel extends FeedModel
    {
        /**
         * @var UserId
         */
        private $userId;

        public function getUserId(): UserId
        {
            return $this->userId;
        }

        public function setUserId(UserId $userId)
        {
            $this->userId = $userId;
        }
    }
}
