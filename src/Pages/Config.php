<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class Config extends Page
{
    protected static ?string $title = 'OPcache Config';

    protected static ?string $navigationLabel = 'Config';

    protected static ?string $slug = 'opcache-config';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog';

    protected string $view = 'filament-opcache::status';

    protected static string | UnitEnum | null $navigationGroup = 'OPcache';

    public array $tabs = ['Directives', 'Version', 'Blacklist'];

    public string $activeTab = 'directives';

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
        $config = OpcacheFacade::getConfig();

        return [
            'directives' => collect($config['directives'])
                ->map(function ($value) {
                    if (is_bool($value)) {
                        return $value ? 'true' : 'false';
                    }

                    return (string)$value;
                }),
            'version'    => collect($config['version']),
            'blacklist'  => collect($config['blacklist']),
        ];
    }
}
