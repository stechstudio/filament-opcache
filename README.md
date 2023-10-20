# OPcache for Filament
This package allows you to view OPcache data from your Filament admin panel.

```
composer require stechstudio/filament-opcache
```

In your `AdminPanelProvider` (or other `PanelProvider`), add this package to your plugins:
```php
$panel
    ->plugins([
        \STS\FilamentOpcache\FilamentOpcachePlugin::make(),
    ])
```

| Status Page |
|---|
| ![Status Page](/screenshots/Status.png) |
| Categorized view of all OPcache status data formatted for readability. |

| Config Page |
|---|
| ![Config Page](/screenshots/Config.png) |

| Widgets |
|---|
| ![Widgets](/screenshots/Widgets.png) |
