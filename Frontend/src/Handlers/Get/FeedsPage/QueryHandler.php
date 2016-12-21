<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\FeedsPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Models\FeedsPageModel;
    use Timetabio\Frontend\Queries\FetchUserFeedsQuery;

    class QueryHandler implements QueryHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var FetchUserFeedsQuery
         */
        private $fetchUserFeedsQuery;

        public function __construct(FetchUserFeedsQuery $fetchUserFeedsQuery)
        {
            $this->fetchUserFeedsQuery = $fetchUserFeedsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedsPageModel $model */

            $model->setTitle($this->getTranslator()->translate('Feeds'));
            $model->setFeeds($this->fetchUserFeedsQuery->execute());
        }
    }
}
