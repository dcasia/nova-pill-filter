<?php

declare(strict_types = 1);

namespace DigitalCreative\PillFilter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class PillFilterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Nova::serving(function (ServingNova $event): void {

            Nova::script('pill-filter', __DIR__ . '/../dist/js/filter.js');
            Nova::style('pill-filter', __DIR__ . '/../dist/css/card.css');

        });
    }
}
