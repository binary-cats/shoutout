<?php

declare(strict_types=1);

namespace BinaryCats\Shoutout;

use Illuminate\Support\Arr;

class Shoutout
{
    /**
     * Get a random title using the default type.
     */
    public function random(): string
    {
        $type = config('shoutout.default', 'info');

        return $this->fromType($type);
    }

    /**
     * Get a random success title.
     */
    public function success(): string
    {
        return $this->fromType('success');
    }

    /**
     * Get a random info title.
     */
    public function info(): string
    {
        return $this->fromType('info');
    }

    /**
     * Get a random warning title.
     */
    public function warning(): string
    {
        return $this->fromType('warning');
    }

    /**
     * Get a random danger title.
     */
    public function danger(): string
    {
        return $this->fromType('danger');
    }

    /**
     * Get a random error title.
     */
    public function error(): string
    {
        return $this->fromType('error');
    }

    /**
     * Get a random title from the specified type.
     */
    protected function fromType(string $type): string
    {
        $titles = config("shoutout.messages.{$type}", []);

        if (empty($titles)) {
            return ucfirst($type);
        }

        return Arr::random($titles);
    }
}
