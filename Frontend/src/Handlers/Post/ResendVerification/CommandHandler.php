<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\ResendVerification
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\ResendVerificationCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\ResendVerificationModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var ResendVerificationCommand
         */
        private $resendVerificationCommand;

        public function __construct(ResendVerificationCommand $resendVerificationCommand)
        {
            $this->resendVerificationCommand = $resendVerificationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResendVerificationModel $model */

            $data = ['redirect' => '/register/confirmation'];

            try {
                $this->resendVerificationCommand->execute($model->getEmail());
            } catch (ApiException $exception) {
                $data = [
                    'error' => $exception->getMessage()
                ];
            }

            $model->setData($data);
        }
    }
}
