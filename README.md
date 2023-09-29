# Nova Pill Filter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/digital-creative/nova-pill-filter)](https://packagist.org/packages/digital-creative/nova-pill-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/digital-creative/nova-pill-filter)](https://packagist.org/packages/digital-creative/nova-pill-filter)
[![License](https://img.shields.io/packagist/l/digital-creative/nova-pill-filter)](https://github.com/dcasia/nova-pill-filter/blob/master/LICENSE)

A Laravel Nova filter that renders into clickable pills.

![PillFilter in Action](https://raw.githubusercontent.com/dcasia/nova-pill-filter/master/screenshots/demo-1.png)

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

    public function filters(Request $request)
    {
        return [
            MyFilter::make()->dragMode(),
            MyFilter::make()->stackMode(),
            MyFilter::make()->wrapMode(),
        ];
    }

}
```

## License

The MIT License (MIT). Please see [License File](https://raw.githubusercontent.com/dcasia/nova-pill-filter/master/LICENSE) for more information.
