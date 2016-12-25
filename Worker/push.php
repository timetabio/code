#!/usr/bin/env php
<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
