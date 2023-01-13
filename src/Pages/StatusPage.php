<?php

namespace STS\LaravelFilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use STS\LaravelFilamentOpcache\Models\Status;
use STS\LaravelFilamentOpcache\Widgets\HitAmountWidget;
use STS\LaravelFilamentOpcache\Widgets\MemoryWidget;

class StatusPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $title = 'OPcache Status';

    protected static ?string $navigationLabel = 'Status';

    protected static ?string $slug = 'opcache-status';

    protected static ?string $navigationIcon = 'heroicon-o-database';

    protected static string $view = 'laravel-filament-opcache::status';

    protected static ?string $navigationGroup = 'OPcache';

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

    protected function getTableQuery() 
    {
        return Status::query();
    }

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('key'),
            BooleanColumn::make('value'),
        ];
    }
}
