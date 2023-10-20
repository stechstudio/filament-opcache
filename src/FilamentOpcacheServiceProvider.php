<?php

namespace STS\FilamentOpcache;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use STS\FilamentOpcache\Pages;
use STS\FilamentOpcache\Widgets;

class FilamentOpcacheServiceProvider extends PackageServiceProvider
{
    protected array $pages = [
        Pages\Config::class,
        Pages\Status::class,
    ];

    protected array $widgets = [
        Widgets\OpcacheHitsWidget::class,
        Widgets\OpcacheMemoryWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-filament-opcache')
            ->hasViews('laravel-filament-opcache');
    }
}
