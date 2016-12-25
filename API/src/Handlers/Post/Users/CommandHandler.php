<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Users
{
    use Timetabio\API\Commands\SendVerificationCommand;
    use Timetabio\API\Commands\User\CreateUserCommand;
    use Timetabio\API\Models\User\CreateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\EmailPerson;
    use Timetabio\Framework\ValueObjects\Token;
    use Timetabio\Library\Mappers\DocumentMapper;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateUserCommand
         */
        private $createUserCommand;

        /**
         * @var SendVerificationCommand
         */
        private $sendVerificationCommand;

        /**
         * @var DocumentMapper
         */
        private $getUserMapper;

        public function __construct(
            CreateUserCommand $createUserCommand,
            SendVerificationCommand $sendVerificationCommand,
            DocumentMapper $getUserMapper
        )
        {
            $this->createUserCommand = $createUserCommand;
            $this->sendVerificationCommand = $sendVerificationCommand;
            $this->getUserMapper = $getUserMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $token = new Token;

            $email = $model->getEmail();
            $username = $model->getUsername();

            $user = $this->createUserCommand->execute($email, $username, $model->getPassword(), $token);
            $mappedUser = $this->getUserMapper->map($user);

            $this->sendVerificationCommand->execute(new EmailPerson($email, $username), $token);

            $model->setData($mappedUser);
        }
    }
}
