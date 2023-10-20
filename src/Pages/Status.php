<?php

namespace STS\FilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;
use Illuminate\Support\Carbon;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use STS\FilamentOpcache\Memory;

class Status extends Page
{
    protected static ?string $title = 'OPcache Status';

    protected static ?string $navigationLabel = 'Status';

    protected static ?string $slug = 'opcache-status';

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static string $view = 'filament-opcache::status';

    protected static ?string $navigationGroup = 'OPcache';

    public array $tabs = ['Lifecycle', 'Memory', 'Strings', 'Statistics', 'JIT'];

    public string $activeTab = 'lifecycle';

    /** @noinspection DuplicatedCode */
    protected function getActions(): array
    {
        return [
            Action::make('compile')
                ->label('Compile Scripts')
                ->action(function () {
                    $result = OpcacheFacade::compile(true);

                    Notification::make()
                        ->title('Scripts Compiled')
                        ->body($result['compiled_count'] . ' files compiled successfully.')
                        ->success()
                        ->send();
                }),
            Action::make('clear')
                ->label('Clear OPcache')
                ->action(function () {
                    if (OpcacheFacade::clear()) {
                        Notification::make()->title('OPcache Cleared')->success()->send();
                    } else {
                        Notification::make()->title('OPcache Disabled')->warning()->send();
                    }
                }),
        ];
    }

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
