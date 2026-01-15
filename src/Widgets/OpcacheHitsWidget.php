<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Widgets;

use Appstract\Opcache\OpcacheFacade;

class OpcacheHitsWidget extends PercentageChart
{
    protected static ?string $pollingInterval = '10s';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $status = OpcacheFacade::getStatus();

        return $this->chartDataFor('Hits',
            __('filament-opcache::widgets.hits.categories.hits'), $status['opcache_statistics']['hits'],
            __('filament-opcache::widgets.hits.categories.misses'), $status['opcache_statistics']['misses']
        );
    }
}
