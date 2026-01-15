<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;

class Config extends Page
{
    protected static ?string $slug = 'opcache-config';

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament-opcache::status';

    protected static ?string $navigationGroup = 'OPcache';

    public array $tabs = ['directives', 'version', 'blacklist'];

    public string $activeTab = 'directives';

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
