<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Feed\Upload
{
    use Timetabio\API\Commands\Feed\CreateFeedUploadUrlCommand;
    use Timetabio\API\Commands\File\CreateFileCommand;
    use Timetabio\API\Models\Feed\UploadModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateFeedUploadUrlCommand
         */
        private $createFeedUploadUrlCommand;

        /**
         * @var CreateFileCommand
         */
        private $createFileCommand;

        public function __construct(CreateFeedUploadUrlCommand $createFeedUploadUrlCommand, CreateFileCommand $createFileCommand)
        {
            $this->createFeedUploadUrlCommand = $createFeedUploadUrlCommand;
            $this->createFileCommand = $createFileCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UploadModel $model */

            $uploadParams = $this->createFeedUploadUrlCommand->execute(
                $model->getFilename(),
                $model->getMimeType()
            );

            $this->createFileCommand->execute(
                $model->getAuthUserId(),
                $uploadParams->getFile(),
                $model->getMimeType()
            );

            $model->setData([
                'public_id' => (string) $uploadParams->getFile()->getPublicId(),
                'endpoint' => $uploadParams->getEndpoint(),
                'params' => $uploadParams->getParams()
            ]);
        }
    }
}
