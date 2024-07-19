<?php

declare(strict_types=1);

namespace STS\FilamentOpcache;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\Facades\Log;

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
        if (function_exists('opcache_get_status')) {
            $panel
                ->pages([
                    Pages\Config::class,
                    Pages\Status::class,
                ])
                ->widgets([
                    Widgets\OpcacheHitsWidget::class,
                    Widgets\OpcacheMemoryWidget::class,
                ]);
        } else {
            Log::warning('FilamentOpcachePlugin will not work because OpCache is disabled in php.ini');
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
