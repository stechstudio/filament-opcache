<?php

namespace STS\LaravelFilamentOpcache;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use STS\LaravelFilamentOpcache\Pages\Opcache;

class LaravelFilamentOpcacheServiceProvider extends PluginServiceProvider
{
    protected array $pages = [
        Opcache::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package->name('laravel-filament-opcache');
    }
}
