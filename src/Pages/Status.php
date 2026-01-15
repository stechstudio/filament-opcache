<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;
use Carbon\Carbon;
use Illuminate\Support\Str;
use STS\FilamentOpcache\Memory;

class Status extends Page
{
    protected static ?string $slug = 'opcache-status';

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static string $view = 'filament-opcache::status';

    protected static ?string $navigationGroup = 'OPcache';

    public array $tabs = ['lifecycle', 'memory', 'strings', 'statistics', 'jit'];

    public string $activeTab = 'lifecycle';

    protected function getViewData(): array
    {
        $status = OpcacheFacade::getStatus();

        return [
            'lifecycle'  => collect($status)
                ->filter(fn($value, $key) => ! is_array($value))
                ->map(fn($value) => $value ? 'true' : 'false'),
            'memory'     => collect($status['memory_usage'])
                ->map(fn($value, $key) => Str::contains($key, 'percentage') ?
                    number_format($value, 2) . '%' :
                    Memory::humanReadable($value)),
            'strings'    => collect($status['interned_strings_usage'])
                ->map(fn($value, $key) => Str::contains($key, 'number_of') ?
                    number_format($value) :
                    Memory::humanReadable($value)),
            'statistics' => collect($status['opcache_statistics'])
                ->map(function ($value, $key) {
                    if (Str::contains($key, 'ratio')) {
                        return number_format($value, 2);
                    }

                    if (Str::contains($key, 'rate')) {
                        return number_format($value, 2) . '%';
                    }

                    if (Str::contains($key, 'time')) {
                        return (string)(new Carbon($value));
                    }

                    return number_format($value);
                }),
            'jit'        => collect($status['jit'])
                ->map(function ($value) {
                    if (is_bool($value)) {
                        return $value ? 'true' : 'false';
                    }

                    return number_format($value);
                }),
        ];
    }
}
