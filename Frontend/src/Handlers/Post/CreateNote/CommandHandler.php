<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\CreateNote
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\CreateNoteCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\CreateNoteModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateNoteCommand
         */
        private $createNoteCommand;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(CreateNoteCommand $createNoteCommand, UriBuilder $uriBuilder)
        {
            $this->createNoteCommand = $createNoteCommand;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateNoteModel $model */

            $model->setData($this->process($model));
        }

        private function process(CreateNoteModel $model): array
        {
            try {
                $post = $this->createNoteCommand->execute(
                    $model->getFeedId(),
                    $model->getPostTitle(),
                    $model->getPostBody(),
                    $model->getAttachments()
                );

                return [
                    'redirect' => $this->uriBuilder->buildPostPageUri($post['id'])
                ];
            } catch (ApiException $exception) {
                return [
                    'error' => $exception->getMessage()
                ];
            }
        }
    }
}
