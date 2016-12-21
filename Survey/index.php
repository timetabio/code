<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey
{
    use Timetabio\Framework\FrontController;
    use Timetabio\Survey\Bootstrap\Bootstrapper;

    require __DIR__ . '/bootstrap.php';

    (new FrontController(new Bootstrapper()))->run();
}
