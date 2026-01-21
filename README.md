# OPcache for Filament
This package allows you to view OPcache data from your Filament admin panel.

```
composer require stechstudio/filament-opcache
```

In your `AdminPanelProvider` (or other `\Filament\PanelProvider`), add this package to your plugins:
```php
$panel
    ->plugins([
        \STS\FilamentOpcache\FilamentOpcachePlugin::make(),
    ])
```

> Filament v4 requires you [create a custom theme](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) to support a package's additional Tailwind classes. Be sure to follow those instructions before continuing with this step.

In `resources/css/filament/admin/theme.css`, import the package's CSS:

```css
@import '../../../../vendor/stechstudio/filament-opcache/dist/theme.css';
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
