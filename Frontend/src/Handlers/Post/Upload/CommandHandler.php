<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\Upload
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\CreateUploadCommand;
    use Timetabio\Frontend\Models\Action\UploadModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateUploadCommand
         */
        private $createUploadCommand;

        public function __construct(CreateUploadCommand $createUploadCommand)
        {
            $this->createUploadCommand = $createUploadCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UploadModel $model */

            $model->setData($this->createUploadCommand->execute(
                $model->getFilename(),
                $model->getMimeType()
            ));
        }
    }
}
