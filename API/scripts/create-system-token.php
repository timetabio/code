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
namespace Timetabio\API
{
    use Timetabio\API\Access\AccessTypes\SystemAccess;
    use Timetabio\API\ValueObjects\AccessToken;
    use Timetabio\Framework\ValueObjects\Token;

    require __DIR__ . '/../bootstrap.php';

    $config = parse_ini_file(__DIR__ . '/../config/system.ini', false);

    $token = new Token;
    $accessToken = new AccessToken($token, new SystemAccess);

    $redis = new \Redis();
    $redis->connect($config['redisHost']);

    if ($redis->exists('system_token')) {
        echo 'System token already exists.' . PHP_EOL;
        exit;
    }

    $redis->set('access_token_' . $token, serialize($accessToken));
    $redis->set('system_token', (string) $token);

    echo 'System token created.' . PHP_EOL;
}
