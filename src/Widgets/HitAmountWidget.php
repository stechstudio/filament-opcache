<?php

namespace STS\LaravelFilamentOpcache\Widgets;

use Appstract\Opcache\OpcacheFacade;

class HitAmountWidget extends PercentageChart
{
    protected static ?string $heading = 'Hit Amount';

    protected static ?string $pollingInterval = '10s';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $status = OpcacheFacade::getStatus();

        return $this->chartDataFor('Memory',
            'Hits', $status['opcache_statistics']['hits'],
            'Misses', $status['opcache_statistics']['misses']
        );
    }
}
