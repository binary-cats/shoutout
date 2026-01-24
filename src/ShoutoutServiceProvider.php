<?php

declare(strict_types=1);

namespace BinaryCats\Shoutout;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ShoutoutServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('shoutout')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(Shoutout::class);
    }
}
