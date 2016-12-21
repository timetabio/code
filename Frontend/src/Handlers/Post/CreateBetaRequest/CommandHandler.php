<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\CreateBetaRequest
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Commands\CreateBetaRequestCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Models\Action\CreateBetaRequestModel;

    class CommandHandler implements CommandHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var CreateBetaRequestCommand
         */
        private $createBetaRequestCommand;

        public function __construct(CreateBetaRequestCommand $createBetaRequestCommand)
        {
            $this->createBetaRequestCommand = $createBetaRequestCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateBetaRequestModel $model */

            try {
                $this->createBetaRequestCommand->execute($model->getEmail());
            } catch (ApiException $exception) {
                throw new BadRequest($this->getTranslator()->translate($exception));
            }

            $model->setData([
                'redirect' => '/beta/thanks'
            ]);
        }
    }
}
