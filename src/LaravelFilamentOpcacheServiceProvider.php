<?php

namespace STS\LaravelFilamentOpcache;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use STS\LaravelFilamentOpcache\Pages;
use STS\LaravelFilamentOpcache\Widgets\HitAmountWidget;
use STS\LaravelFilamentOpcache\Widgets\MemoryWidget;

class LaravelFilamentOpcacheServiceProvider extends PluginServiceProvider
{
    protected array $pages = [
        Pages\StatusPage::class,
    ];

    protected array $widgets = [
        HitAmountWidget::class,
        MemoryWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-filament-opcache')
            ->hasViews('laravel-filament-opcache');
    }
}
