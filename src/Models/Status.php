<?php

namespace STS\LaravelFilamentOpcache\Models;

use Appstract\Opcache\OpcacheFacade;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Status extends Model
{
    use Sushi;

    protected $schema = [
        'key' => 'string',
        'value' => 'boolean',
    ];

    public function getRows()
    {
        return collect(OpcacheFacade::getStatus())
            ->filter(fn ($value, $key) => !is_array($value))
            ->map(fn ($value, $key) => ['key' => $key, 'value' => $value])
            ->values()
            ->toArray();
    }
}
