<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\InviteFeedUser
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Commands\InviteFeedUserCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\InviteFeedUserModel;

    class CommandHandler implements CommandHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var InviteFeedUserCommand
         */
        private $inviteFeedUserCommand;

        public function __construct(InviteFeedUserCommand $inviteFeedUserCommand)
        {
            $this->inviteFeedUserCommand = $inviteFeedUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var InviteFeedUserModel $model */

            try {
                $this->inviteFeedUserCommand->execute($model->getFeedId(), $model->getUsername(), $model->getRole());
            } catch (ApiException $exception) {
                $model->setData([
                    'error' => $this->getTranslator()->translate($exception->getMessage())
                ]);

                return;
            }

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
