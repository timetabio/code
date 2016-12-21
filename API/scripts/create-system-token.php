#!/usr/bin/env php
<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
