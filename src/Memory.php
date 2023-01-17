<?php

namespace STS\LaravelFilamentOpcache;

class Memory
{
    public static function humanReadable($bytes = 0)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.2f", $bytes / pow(1024, $factor)) . ' ' . @$size[intval($factor)];
    }
}
