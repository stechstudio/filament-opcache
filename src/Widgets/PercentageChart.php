<?php

declare(strict_types=1);

namespace STS\FilamentOpcache\Widgets;

use Filament\Widgets\PieChartWidget;
use Illuminate\Contracts\Support\Htmlable;

abstract class PercentageChart extends PieChartWidget
{
    public function getHeading(): string | Htmlable | null
    {
        $translations = static::getTranslations();

        return $translations['heading'] ?? parent::getHeading();
    }

    protected static function getTranslations(): ?array
    {
        $key = str(class_basename(static::class))
            ->ltrim('OpCache')->rtrim('Widget')
            ->lower()->value();

        $translations = __('filament-opcache::widgets');

        return $translations[$key] ?? null;
    }

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
