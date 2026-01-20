<?php

namespace STS\FilamentOpcache;

use STS\FilamentOpcache\Pages\Config;
use STS\FilamentOpcache\Pages\Status;
use STS\FilamentOpcache\Widgets\OpcacheHitsWidget;
use STS\FilamentOpcache\Widgets\OpcacheMemoryWidget;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;

class FilamentOpcachePlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-opcache';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Config::class,
                Status::class,
            ])
            ->widgets([
                OpcacheHitsWidget::class,
                OpcacheMemoryWidget::class,
            ])
            ->viteTheme('vendor/stechstudio/filament-opcache/resources/css/theme.css');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
