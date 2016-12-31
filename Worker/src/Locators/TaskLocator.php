<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Locators
{
    use Timetabio\Library\Tasks\TaskInterface;

    class TaskLocator
    {
        public function locate(string $taskName, string ...$args): TaskInterface
        {
            switch ($taskName) {
                case 'BuildStaticPages':
                    return new \Timetabio\Library\Tasks\BuildStaticPagesTask;
                case 'DeleteUnusedFiles':
                    return new \Timetabio\Library\Tasks\DeleteUnusedFilesTask;
                case 'Initial':
                    return new \Timetabio\Library\Tasks\InitialTask;
                case 'BuildPosts':
                    return new \Timetabio\Library\Tasks\BuildPostsTask;
                case 'IndexPosts':
                    return new \Timetabio\Library\Tasks\IndexPostsTask;
                case 'BuildFeeds':
                    return new \Timetabio\Library\Tasks\BuildFeedsTask;
                case 'IndexFeeds':
                    return new \Timetabio\Library\Tasks\IndexFeedsTask;
                case 'IndexUsers':
                    return new \Timetabio\Library\Tasks\IndexUsersTask;
                case 'DeleteArchivedPosts':
                    return new \Timetabio\Library\Tasks\DeleteArchivedPostsTask;
                case 'SendBetaInvitations':
                    return new \Timetabio\Library\Tasks\SendBetaInvitationsTask;
                case 'SendBetaInvitation':
                    return new \Timetabio\Library\Tasks\SendBetaInvitationTask($args[0]);
            }

            throw new \Exception('could not locate task \'' . $taskName . '\'');
        }
    }
}
