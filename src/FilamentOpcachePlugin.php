<?php

namespace STS\FilamentOpcache;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentOpcachePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-opcache';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Pages\Config::class,
                Pages\Status::class,
            ])
            ->widgets([
                Widgets\OpcacheHitsWidget::class,
                Widgets\OpcacheMemoryWidget::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
