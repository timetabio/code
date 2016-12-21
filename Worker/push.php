#!/usr/bin/env php
<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker
{
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Locators\TaskLocator;

    require __DIR__ . '/bootstrap.php';

    $factory = (new Bootstrapper)->getFactory();

    /** @var TaskLocator $locator */
    $locator = $factory->createTaskLocator();

    /** @var DataStoreWriter $dataStoreWriter */
    $dataStoreWriter = $factory->createDataStoreWriter();

    $task = $locator->locate($argv[1]);

    $dataStoreWriter->queueTask($task);

    echo 'Pushed task ' . get_class($task) . ' to worker queue' . PHP_EOL;
}
