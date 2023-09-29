<?php

declare(strict_types = 1);

namespace DigitalCreative\PillFilter;

use Laravel\Nova\Filters\Filter;

abstract class PillFilter extends Filter
{
    public $component = 'pill-filter';
    public string $noneLabel = 'All';

    public function __construct()
    {
        $this->withMeta([
            'showSelectNoneButton' => true,
            'single' => false,
            'mode' => 'wrap',
            'noneLabel' => $this->getNoneLabel(),
        ]);
    }

    public function getNoneLabel(): string
    {
        return $this->noneLabel;
    }

    public function dragMode(): self
    {
        return $this->withMeta([ 'mode' => 'drag' ]);
    }

    public function single(): self
    {
        return $this->withMeta([ 'single' => true ]);
    }

    public function noneLabel(string $label): self
    {
        return $this->withMeta([ 'noneLabel' => $label ]);
    }

    public function hideSelectNoneButton(): self
    {
        return $this->withMeta([ 'showSelectNoneButton' => false ]);
    }
}
