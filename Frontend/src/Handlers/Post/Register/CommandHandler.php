<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Register
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareTrait;
    use Timetabio\Frontend\Commands\RegisterCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\RegisterModel;

    class CommandHandler implements CommandHandlerInterface, TranslatorAwareInterface
    {
        use TranslatorAwareTrait;

        /**
         * @var RegisterCommand
         */
        private $registerCommand;

        public function __construct(RegisterCommand $registerCommand)
        {
            $this->registerCommand = $registerCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var RegisterModel $model */

            $model->setData($this->doExecute($model));
        }

        private function doExecute(RegisterModel $model): array
        {
            try {
                $this->registerCommand->execute($model->getEmail(), $model->getUsername(), $model->getPassword());
            } catch (ApiException $exception) {
                return [
                    'error' => $this->getTranslator()->translate($exception->getMessage())
                ];
            }

            return [
                'redirect' => '/register/confirmation'
            ];
        }
    }
}
