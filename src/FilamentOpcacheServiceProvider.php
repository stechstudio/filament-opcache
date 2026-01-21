<?php

declare(strict_types=1);

namespace STS\FilamentOpcache;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Filament\Facades\Filament;

class FilamentOpcacheServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-opcache';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }
}
