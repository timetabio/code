<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Reset
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Commands\ResetCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\ResetModel;

    class CommandHandler implements CommandHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var ResetCommand
         */
        private $resetCommand;

        public function __construct(ResetCommand $resetCommand)
        {
            $this->resetCommand = $resetCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResetModel $model */

            $data = ['redirect' => '/account/reset-complete'];

            try {
                $this->resetCommand->execute(
                    $model->getResetToken(),
                    $model->getPassword()
                );
            } catch (ApiException $exception) {
                $data = [
                    'error' => $this->getTranslator()->translate($exception)
                ];
            }

            $model->setData($data);
        }
    }
}
