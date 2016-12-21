<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Locators
{
    use Timetabio\Library\Tasks\TaskInterface;

    class TaskLocator
    {
        public function locate(string $taskName): TaskInterface
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
            }

            throw new \Exception('could not locate task \'' . $taskName . '\'');
        }
    }
}
