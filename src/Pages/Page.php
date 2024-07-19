<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Pages;

use Appstract\Opcache\OpcacheFacade;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page as FilamentPage;
use Illuminate\Contracts\Support\Htmlable;

abstract class Page extends FilamentPage
{
    public function getTitle(): string | Htmlable
    {
        $translations = static::getTranslations();

        return $translations['title'] ?? parent::getTitle();
    }

    public static function getNavigationLabel(): string
    {
        $translations = static::getTranslations();

        return $translations['navigation_label'] ?? parent::getNavigationLabel();
    }

    protected static function getTranslations(): ?array
    {
        $key = str(class_basename(static::class))->lower()->value();

        $translations = __('filament-opcache::pages');

        return $translations[$key] ?? null;
    }

    protected function getActions(): array
    {
        return [
            Action::make('compile')
                ->label(__('filament-opcache::actions.compile.label'))
                ->action(function () {
                    $result = OpcacheFacade::compile(true);

                    Notification::make()
                        ->title(__('filament-opcache::notifications.compile.title'))
                        ->body(__('filament-opcache::notifications.compile.body', $result))
                        ->success()
                        ->send();
                }),

            Action::make('clear')
                ->label(__('filament-opcache::actions.clear.label'))
                ->action(function () {
                    if (OpcacheFacade::clear()) {
                        Notification::make()
                            ->title(__('filament-opcache::notifications.cleared.title'))
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title(__('filament-opcache::notifications.disabled.title'))
                            ->warning()
                            ->send();
                    }
                }),
        ];
    }
}
