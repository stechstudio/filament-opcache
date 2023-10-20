<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Widgets;

use Filament\Widgets\PieChartWidget;

abstract class PercentageChart extends PieChartWidget
{
    protected function chartDataFor($title, $labelA, $valueA, $labelB, $valueB): array
    {
        return [
            'labels'   => [
                $labelA . ' ' . $this->percentage($valueA, $valueA + $valueB),
                $labelB . ' ' . $this->percentage($valueB, $valueA + $valueB),
            ],
            'datasets' => [
                [
                    'label'           => $title,
                    'data'            => [
                        $valueA,
                        $valueB,
                    ],
                    'backgroundColor' => [
                        '#1c3d5a',
                        '#8795a1',
                    ],
                ],
            ],
        ];
    }

    private function percentage($part, $total): string
    {
        return '(' . round(($part / $total) * 100, 2) . '%)';
    }
}
