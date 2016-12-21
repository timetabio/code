<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Get\Account\Verify
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Commands\VerifyCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Account\VerifyModel;

    class CommandHandler implements CommandHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var VerifyCommand
         */
        private $verifyCommand;

        public function __construct(VerifyCommand $verifyCommand)
        {
            $this->verifyCommand = $verifyCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var VerifyModel $model */

            $model->setTitle($this->getTranslator()->translate('Verify'));

            if ($model->hasStatusCode() && $model->getStatusCode() instanceof \Timetabio\Framework\Http\StatusCodes\NotFound) {
                return;
            }

            try {
                $this->verifyCommand->execute($model->getToken());
            } catch (ApiException $exception) {
                $error = $exception->getMessage();

                if ($error === 'invalid_token') {
                    $model->setStatusCode(new \Timetabio\Framework\Http\StatusCodes\NotFound);
                } else {
                    throw new \RuntimeException('unexpected api response');
                }
            }
        }
    }
}
