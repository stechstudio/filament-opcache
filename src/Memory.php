<?php

declare(strict_types=1);

namespace STS\FilamentOpcache;

class Memory
{
    public static function humanReadable(int $bytes = 0): string
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen((string)$bytes) - 1) / 3);

        return sprintf("%.2f", (string)$bytes / pow(1024, $factor)) . ' ' . @$size[intval($factor)];
    }
}
