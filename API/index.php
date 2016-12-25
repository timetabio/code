<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API
{
    use Timetabio\API\Bootstrap\Bootstrapper;
    use Timetabio\Framework\FrontController;

    require __DIR__ . '/bootstrap.php';

    (new FrontController(new Bootstrapper()))->run();
}
