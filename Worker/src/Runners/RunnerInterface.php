<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\TaskInterface;

    interface RunnerInterface
    {
        public function run(TaskInterface $task);
    }
}
