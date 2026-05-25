<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component
{
    public string $placeholder;
    public string $route;
    public array $extras;

    public function __construct(
        string $placeholder = 'Cari...',
        string $route = '',
        array $extras = []
    ) {
        $this->placeholder = $placeholder;
        $this->route       = $route;
        $this->extras      = $extras;
    }

    public function render()
    {
        return view('components.search-bar');
    }
}