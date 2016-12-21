#!/usr/bin/env php
<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker
{
    require __DIR__ . '/bootstrap.php';

    (new Bootstrapper)->getFactory()
        ->createWorker()
        ->start();
}
