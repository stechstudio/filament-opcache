<?php

namespace STS\LaravelFilamentOpcache;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class LaravelFilamentOpcacheServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-filament-opcache');
    }
}
