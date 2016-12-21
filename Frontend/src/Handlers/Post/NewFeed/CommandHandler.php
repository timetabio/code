<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\NewFeed
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\CreateFeedCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Account\NewFeedModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateFeedCommand
         */
        private $createFeedCommand;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(CreateFeedCommand $createFeedCommand, UriBuilder $uriBuilder)
        {
            $this->createFeedCommand = $createFeedCommand;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var NewFeedModel $model */

            $model->setData($this->process($model));
        }

        private function process(NewFeedModel $model): array
        {
            try {
                $feed = $this->createFeedCommand->execute(
                    $model->getFeedName(),
                    $model->getFeedDescription(),
                    $model->getFeedIsPrivate()
                );

                return [
                    'redirect' => $this->uriBuilder->buildFeedPageUri($feed['id'])
                ];
            } catch (ApiException $exception) {
                return [
                    'error' => $exception->getMessage()
                ];
            }
        }
    }
}
