<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\InitialTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;

    class InitialRunner implements RunnerInterface
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!($task instanceof InitialTask)) {
                return;
            }

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\BuildStaticPagesTask);
            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\DeleteUnusedFilesTask);
        }
    }
}
