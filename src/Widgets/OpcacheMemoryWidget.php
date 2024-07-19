<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Widgets;

use Appstract\Opcache\OpcacheFacade;

class OpcacheMemoryWidget extends PercentageChart
{
    protected static ?string $pollingInterval = '10s';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $status = OpcacheFacade::getStatus();

        return $this->chartDataFor('Memory',
            __('filament-opcache::widgets.memory.categories.used'), $status['memory_usage']['used_memory'],
            __('filament-opcache::widgets.memory.categories.free'), $status['memory_usage']['free_memory']
        );
    }
}
