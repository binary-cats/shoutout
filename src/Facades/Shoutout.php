<?php

declare(strict_types=1);

namespace BinaryCats\Shoutout\Facades;

use BinaryCats\Shoutout\Shoutout as ShoutoutInstance;
use BinaryCats\Shoutout\ShoutoutFake;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string random()
 * @method static string success()
 * @method static string info()
 * @method static string warning()
 * @method static string danger()
 * @method static string error()
 *
 * @see ShoutoutInstance
 */
class Shoutout extends Facade
{
    /**
     * Replace the bound instance with a fake for testing.
     */
    public static function fake(): ShoutoutFake
    {
        $fake = new ShoutoutFake;

        static::swap($fake);

        return $fake;
    }

    protected static function getFacadeAccessor(): string
    {
        return ShoutoutInstance::class;
    }
}
