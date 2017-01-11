<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class CommandFactory extends AbstractChildFactory
    {
        public function createApproveBetaRequestCommand(): \Timetabio\Survey\Commands\ApproveBetaRequestCommand
        {
            return new \Timetabio\Survey\Commands\ApproveBetaRequestCommand(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createInsertAnswerCommand(): \Timetabio\Survey\Commands\InsertAnswerCommand
        {
            return new \Timetabio\Survey\Commands\InsertAnswerCommand(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }

        public function createInsertCommentCommand(): \Timetabio\Survey\Commands\InsertCommentCommand
        {
            return new \Timetabio\Survey\Commands\InsertCommentCommand(
                $this->getMasterFactory()->createPostgresBackend()
            );
        }
    }
}
