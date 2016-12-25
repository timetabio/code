<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers
{
    use Timetabio\Framework\Handlers\PostHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\WriteSessionCommand;
    use Timetabio\Frontend\Session\Session;

    class PostHandler implements PostHandlerInterface
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var WriteSessionCommand
         */
        private $writeSessionCommand;

        public function __construct(Session $session, WriteSessionCommand $writeSessionCommand)
        {
            $this->session = $session;
            $this->writeSessionCommand = $writeSessionCommand;
        }

        public function execute(AbstractModel $model)
        {
            $this->writeSessionCommand->execute($this->session);
        }
    }
}
