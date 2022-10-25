<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchTermField extends Component
{
    public $searchTerm;

    public function updatedSearchTerm(): void
    {
        $this->emit('updatedSearchTerm', $this->searchTerm);
    }

    public function render(): View|Factory
    {
        return view('livewire.search-term-field');
    }
}
