<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class RunnerFactory extends AbstractChildFactory
    {
        public function createSendVerificationEmailRunner(): \Timetabio\Worker\Runners\SendVerificationEmailRunner
        {
            return new \Timetabio\Worker\Runners\SendVerificationEmailRunner(
                $this->getMasterFactory()->createMailgunBackend(),
                $this->getMasterFactory()->createVerificationMail()
            );
        }

        public function createIndexUserRunner(): \Timetabio\Worker\Runners\IndexUserRunner
        {
            return new \Timetabio\Worker\Runners\IndexUserRunner(
                $this->getMasterFactory()->createUserService(),
                $this->getMasterFactory()->createUserIndexer()
            );
        }

        public function createBuildStaticPagesRunner(): \Timetabio\Worker\Runners\BuildStaticPagesRunner
        {
            return new \Timetabio\Worker\Runners\BuildStaticPagesRunner(
                $this->getMasterFactory()->createFileBackend(),
                $this->getMasterFactory()->createDataStoreWriter(),
                $this->getMasterFactory()->createStaticPageBuilder()
            );
        }

        public function createInitialRunner(): \Timetabio\Worker\Runners\InitialRunner
        {
            return new \Timetabio\Worker\Runners\InitialRunner(
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createDeleteUnusedFilesRunner(): \Timetabio\Worker\Runners\DeleteUnusedFilesRunner
        {
            return new \Timetabio\Worker\Runners\DeleteUnusedFilesRunner(
                $this->getMasterFactory()->createAwsRestBackend(),
                $this->getMasterFactory()->createFileService(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createBuildPostsRunner(): \Timetabio\Worker\Runners\BuildPostsRunner
        {
            return new \Timetabio\Worker\Runners\BuildPostsRunner(
                $this->getMasterFactory()->createDataStoreWriter(),
                $this->getMasterFactory()->createPostService()
            );
        }

        public function createBuildPostRunner(): \Timetabio\Worker\Runners\BuildPostRunner
        {
            return new \Timetabio\Worker\Runners\BuildPostRunner(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createInkBackend(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createIndexPostsRunner(): \Timetabio\Worker\Runners\IndexPostsRunner
        {
            return new \Timetabio\Worker\Runners\IndexPostsRunner(
                $this->getMasterFactory()->createDataStoreWriter(),
                $this->getMasterFactory()->createPostService()
            );
        }

        public function createIndexPostRunner(): \Timetabio\Worker\Runners\IndexPostRunner
        {
            return new \Timetabio\Worker\Runners\IndexPostRunner(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createPostMapper(),
                $this->getMasterFactory()->createDataStoreReader(),
                $this->getMasterFactory()->createPostIndexer()
            );
        }

        public function createSendFeedInvitationRunner(): \Timetabio\Worker\Runners\SendFeedInvitationRunner
        {
            return new \Timetabio\Worker\Runners\SendFeedInvitationRunner(
                $this->getMasterFactory()->createUserService(),
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createMailgunBackend(),
                $this->getMasterFactory()->createFeedInvitationMail()
            );
        }

        public function createBuildFeedsRunner(): \Timetabio\Worker\Runners\BuildFeedsRunner
        {
            return new \Timetabio\Worker\Runners\BuildFeedsRunner(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createBuildFeedRunner(): \Timetabio\Worker\Runners\BuildFeedRunner
        {
            return new \Timetabio\Worker\Runners\BuildFeedRunner(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter(),
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createIndexFeedsRunner(): \Timetabio\Worker\Runners\IndexFeedsRunner
        {
            return new \Timetabio\Worker\Runners\IndexFeedsRunner(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createIndexFeedRunner(): \Timetabio\Worker\Runners\IndexFeedRunner
        {
            return new \Timetabio\Worker\Runners\IndexFeedRunner(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createFeedMapper(),
                $this->getMasterFactory()->createFeedIndexer(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createIndexUsersRunner(): \Timetabio\Worker\Runners\IndexUsersRunner
        {
            return new \Timetabio\Worker\Runners\IndexUsersRunner(
                $this->getMasterFactory()->createUserService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }
    }
}
