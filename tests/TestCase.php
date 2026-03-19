<?php

declare(strict_types=1);

namespace BinaryCats\Shoutout\Tests;

use BinaryCats\Shoutout\Facades\Shoutout;
use BinaryCats\Shoutout\ShoutoutServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

require_once __DIR__.'/../src/helpers.php';

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ShoutoutServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Shoutout' => Shoutout::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('shoutout.default', 'info');
        $app['config']->set('shoutout.messages.success', ['Test Success 1', 'Test Success 2']);
        $app['config']->set('shoutout.messages.info', ['Test Info 1', 'Test Info 2']);
        $app['config']->set('shoutout.messages.warning', ['Test Warning 1', 'Test Warning 2']);
        $app['config']->set('shoutout.messages.danger', ['Test Danger 1', 'Test Danger 2']);
        $app['config']->set('shoutout.messages.error', ['Test Error 1', 'Test Error 2']);
    }
}
