<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Collections
{
    use Timetabio\API\Commands\CreateCollectionCommand;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\CollectionName;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class CreateCollectionCommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateCollectionCommand
         */
        private $createCollectionCommand;

        /**
         * @var DocumentMapper
         */
        private $getDocumentMapper;

        public function __construct(
            CreateCollectionCommand $createCollectionCommand,
            DocumentMapper $getDocumentMapper
        )
        {
            $this->createCollectionCommand = $createCollectionCommand;
            $this->getDocumentMapper = $getDocumentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */
            /** @var PostRequest $request */

            try {
                $collectionName = new CollectionName($request->getParam('name'));
            } catch (\Exception $e) {
                throw new BadRequest('invalid name', 'invalid_name');
            }

            $userId = $model->getUserId();
            $collection = $this->createCollectionCommand->execute($collectionName, $userId);
            $mappedCollection = $this->getDocumentMapper->map($collection);

            $model->setData($mappedCollection);
        }
    }
}
