<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Widgets;

use Appstract\Opcache\OpcacheFacade;

class OpcacheMemoryWidget extends PercentageChart
{
    protected ?string $heading = 'OPcache Memory Usage';

    protected ?string $pollingInterval = '10s';

    protected ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $status = OpcacheFacade::getStatus();

        return $this->chartDataFor('Memory',
            'Used', $status['memory_usage']['used_memory'],
            'Free', $status['memory_usage']['free_memory']
        );
    }
}
