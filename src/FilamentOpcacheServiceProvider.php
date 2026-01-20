<?php

declare(strict_types=1);

namespace STS\FilamentOpcache;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Filament\Facades\Filament;

class FilamentOpcacheServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-opcache';

    public function boot(): void
    {
        parent::boot();

        Filament::registerTheme(__DIR__ . '/../dist/filament-opcache.css');
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }
}
