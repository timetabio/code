<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API
{
    use Timetabio\API\Bootstrap\Bootstrapper;
    use Timetabio\Framework\FrontController;

    require __DIR__ . '/bootstrap.php';

    (new FrontController(new Bootstrapper()))->run();
}
