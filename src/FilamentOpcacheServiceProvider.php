<?php

namespace STS\FilamentOpcache;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use STS\FilamentOpcache\Pages;
use STS\FilamentOpcache\Widgets;

class FilamentOpcacheServiceProvider extends PluginServiceProvider
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
