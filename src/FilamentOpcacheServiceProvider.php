<?php

declare(strict_types=1);

namespace STS\FilamentOpcache;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentOpcacheServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-opcache')
            ->hasViews('filament-opcache');
    }
}
