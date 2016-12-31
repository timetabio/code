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
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Library\Tasks;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Runners\RunnerInterface;

    class RunnerLocator
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        public function __construct(MasterFactoryInterface $factory)
        {
            $this->factory = $factory;
        }

        public function locate(TaskInterface $task): RunnerInterface
        {
            $class = get_class($task);

            switch ($class) {
                case Tasks\SendVerificationEmailTask::class:
                    return $this->factory->createSendVerificationEmailRunner();
                case Tasks\IndexUserTask::class:
                    return $this->factory->createIndexUserRunner();
                case Tasks\BuildStaticPagesTask::class:
                    return $this->factory->createBuildStaticPagesRunner();
                case Tasks\InitialTask::class:
                    return $this->factory->createInitialRunner();
                case Tasks\DeleteUnusedFilesTask::class:
                    return $this->factory->createDeleteUnusedFilesRunner();
                case Tasks\BuildPostsTask::class:
                    return $this->factory->createBuildPostsRunner();
                case Tasks\BuildPostTask::class:
                    return $this->factory->createBuildPostRunner();
                case Tasks\IndexPostsTask::class:
                    return $this->factory->createIndexPostsRunner();
                case Tasks\IndexPostTask::class:
                    return $this->factory->createIndexPostRunner();
                case Tasks\SendFeedInvitationTask::class:
                    return $this->factory->createSendFeedInvitationRunner();
                case Tasks\BuildFeedsTask::class:
                    return $this->factory->createBuildFeedsRunner();
                case Tasks\BuildFeedTask::class:
                    return $this->factory->createBuildFeedRunner();
                case Tasks\IndexFeedsTask::class:
                    return $this->factory->createIndexFeedsRunner();
                case Tasks\IndexFeedTask::class:
                    return $this->factory->createIndexFeedRunner();
                case Tasks\IndexUsersTask::class:
                    return $this->factory->createIndexUsersRunner();
                case Tasks\SendPasswordResetEmailTask::class:
                    return $this->factory->createSendResetPasswordEmailRunner();
                case Tasks\DeleteArchivedPostsTask::class:
                    return $this->factory->createDeleteArchivedPostsRunner();
            }

            throw new \RuntimeException('no runner found for task ' . $class);
        }
    }
}
