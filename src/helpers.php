<?php

declare(strict_types=1);

use BinaryCats\Shoutout\Shoutout;

if (! function_exists('shoutout')) {
    /**
     * Get a random shoutout message.
     *
     * @param  string|null  $type  The message type (info, success, warning, danger, error) or null for default
     */
    function shoutout(?string $type = null): string
    {
        $instance = app(Shoutout::class);

        if ($type === null) {
            return $instance->random();
        }

        return match ($type) {
            'success' => $instance->success(),
            'info' => $instance->info(),
            'warning' => $instance->warning(),
            'danger' => $instance->danger(),
            'error' => $instance->error(),
            default => $instance->random(),
        };
    }
}
