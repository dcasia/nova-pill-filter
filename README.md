# Nova Pill Filter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/digital-creative/nova-pill-filter)](https://packagist.org/packages/digital-creative/nova-pill-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/digital-creative/nova-pill-filter)](https://packagist.org/packages/digital-creative/nova-pill-filter)
[![License](https://img.shields.io/packagist/l/digital-creative/nova-pill-filter)](https://github.com/dcasia/nova-pill-filter/blob/main/LICENSE)

A Laravel Nova filter that renders into clickable pills.

<picture>
  <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/dark-1.png">
  <img alt="PillFilter in Action" src="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/light-1.png">
</picture>

# Installation

You can install the package via composer:

```shell
composer require digital-creative/nova-pill-filter
```

## Basic Usage

Create a filter as usual and extend the `DigitalCreative\PillFilter\PillFilter` class

```php
use DigitalCreative\PillFilter\PillFilter;

class MyFilter extends PillFilter {

    public function apply(Request $request, $query, $values)
    {
        // $values will always be an array
    }
    
    public function options(NovaRequest $request): array
    {
        return [
           'Display Text 1' => 'value-1',
           'Display Text 2' => 'value-2'
        ];
    }

}
```

and use it as usual on the filters methods within your resource class:

```php
class ExampleNovaResource extends Resource {

    public function filters(NovaRequest $request): array
    {
        return [
            MyFilter::make()
        ];
    }

}
```

By default, multiple items can be selected, you can restrict it to a single item at time by calling `->single()`

```php
class ExampleNovaResource extends Resource {

    public function filters(NovaRequest $request): array
    {
        return [
            MyFilter::make()->single()
        ];
    }

}
```

Additionally, you can customize the mode the filter is displayed, by default it wraps to show all pills at once, however
there is also a `drag` and `stack` mode:

| Drag Mode                                                                                                                                                                                                                                                                 | Stack Mode                                                                                                                                                                                                                                                                | Wrap Mode                                                                                                                                                                                                                                                               |
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| <picture><source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/drag-dark.png"><img src="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/drag-light.png"></picture>  | <picture><source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/stack-dark.png"><img src="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/stack-light.png"></picture> | <picture><source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/wrap-dark.png"><img src="https://raw.githubusercontent.com/dcasia/nova-pill-filter/main/screenshots/wrap-light.png"></picture> |

```php
class ExampleNovaResource extends Resource {

    public function filters(NovaRequest $request): array
    {
        return [
            MyFilter::make()->dragMode(),
            MyFilter::make()->stackMode(),
            MyFilter::make()->wrapMode(),
        ];
    }

}
```

## ⭐️ Show Your Support

Please give a ⭐️ if this project helped you!

### Other Packages You Might Like

- [Nova Dashboard](https://github.com/dcasia/nova-dashboard) - The missing dashboard for Laravel Nova!
- [Nova Welcome Card](https://github.com/dcasia/nova-welcome-card) - A configurable version of the `Help card` that comes with Nova.
- [Icon Action Toolbar](https://github.com/dcasia/icon-action-toolbar) - Replaces the default boring action menu with an inline row of icon-based actions.
- [Expandable Table Row](https://github.com/dcasia/expandable-table-row) - Provides an easy way to append extra data to each row of your resource tables.
- [Collapsible Resource Manager](https://github.com/dcasia/collapsible-resource-manager) - Provides an easy way to order and group your resources on the sidebar.
- [Resource Navigation Tab](https://github.com/dcasia/resource-navigation-tab) - Organize your resource fields into tabs.
- [Resource Navigation Link](https://github.com/dcasia/resource-navigation-link) - Create links to internal or external resources.
- [Nova Mega Filter](https://github.com/dcasia/nova-mega-filter) - Display all your filters in a card instead of a tiny dropdown!
- [Nova Pill Filter](https://github.com/dcasia/nova-pill-filter) - A Laravel Nova filter that renders into clickable pills.
- [Nova Slider Filter](https://github.com/dcasia/nova-slider-filter) - A Laravel Nova filter for picking range between a min/max value.
- [Nova Range Input Filter](https://github.com/dcasia/nova-range-input-filter) - A Laravel Nova range input filter.
- [Nova FilePond](https://github.com/dcasia/nova-filepond) - A Nova field for uploading File, Image and Video using Filepond.
- [Custom Relationship Field](https://github.com/dcasia/custom-relationship-field) - Emulate HasMany relationship without having a real relationship set between resources.
- [Column Toggler](https://github.com/dcasia/column-toggler) - A Laravel Nova package that allows you to hide/show columns in the index view.
- [Batch Edit Toolbar](https://github.com/dcasia/batch-edit-toolbar) - Allows you to update a single column of a resource all at once directly from the index page.

## License

The MIT License (MIT). Please see [License File](https://raw.githubusercontent.com/dcasia/nova-pill-filter/master/LICENSE) for more information.
