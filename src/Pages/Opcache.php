<?php

namespace STS\LaravelFilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use STS\LaravelFilamentOpcache\Widgets\HitAmountWidget;
use STS\LaravelFilamentOpcache\Widgets\MemoryWidget;

class Opcache extends Page
{
    protected static ?string $title = 'OPcache';

    protected static ?string $navigationLabel = 'OPcache';

    protected static ?string $slug = 'opcache';

    protected static ?string $navigationIcon = 'heroicon-o-database';

    protected static string $view = 'filament.pages.opcache';

    protected static ?string $navigationGroup = 'System Management';

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

    protected function getHeaderWidgets(): array
    {
        return [
            MemoryWidget::class,
            HitAmountWidget::class,
        ];
    }

    protected function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }
}
