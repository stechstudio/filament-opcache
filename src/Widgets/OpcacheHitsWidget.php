<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Widgets;

use Appstract\Opcache\OpcacheFacade;

class OpcacheHitsWidget extends PercentageChart
{
    protected ?string $heading = 'OPcache Hits';

    protected ?string $pollingInterval = '10s';

    protected ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $status = OpcacheFacade::getStatus();

        return $this->chartDataFor('Memory',
            'Hits', $status['opcache_statistics']['hits'],
            'Misses', $status['opcache_statistics']['misses']
        );
    }
}
