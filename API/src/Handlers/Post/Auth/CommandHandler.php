<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Auth
{
    use Timetabio\API\Access\AccessTypes\SystemAccess;
    use Timetabio\API\Commands\SaveAccessTokenCommand;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Models\AuthModel;
    use Timetabio\API\ValueObjects\AccessToken;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\Token;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var SaveAccessTokenCommand
         */
        private $saveAccessTokenCommand;

        public function __construct(SaveAccessTokenCommand $saveAccessTokenCommand)
        {
            $this->saveAccessTokenCommand = $saveAccessTokenCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var AuthModel $model */

            if ($model->getAutoRenew() && !$this->checkAutoRenewAccess($model)) {
                throw new Forbidden('cannot use auto_renew', 'access_denied');
            }

            $token = new Token;

            $accessToken = new AccessToken(
                $token,
                $model->getAccessType(),
                $model->getAuthUserId(),
                $model->getAutoRenew()
            );

            $this->saveAccessTokenCommand->execute($accessToken);

            $model->setData([
                'access_token' => (string) $token,
                'user_id' => (string) $accessToken->getUserId(),
                'expires' => $accessToken->getExpires(),
                'auto_renew' => $accessToken->getAutoRenew(),
                'scopes' => $model->getAccessType()
            ]);
        }

        private function checkAutoRenewAccess(AuthModel $model)
        {
            if (!$model->hasAccessToken()) {
                return false;
            }

            return $model->getAccessToken()->getAccessType() instanceof SystemAccess;
        }
    }
}
