<?php

namespace STS\LaravelFilamentOpcache\Widgets;

use Appstract\Opcache\OpcacheFacade;

class MemoryWidget extends PercentageChart
{
    protected static ?string $heading = 'OPcache Memory Usage';

    protected static ?string $pollingInterval = '10s';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $status = OpcacheFacade::getStatus();

        return $this->chartDataFor('Memory',
            'Used', $status['memory_usage']['used_memory'],
            'Free', $status['memory_usage']['free_memory']
        );
    }
}
