<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend
{
    use Timetabio\Framework\FrontController;
    use Timetabio\Frontend\Bootstrap\Bootstrapper;

    require __DIR__ . '/bootstrap.php';

    (new FrontController(new Bootstrapper()))->run();
}
