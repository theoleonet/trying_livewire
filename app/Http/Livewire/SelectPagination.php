<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SelectPagination extends Component
{
    public $options;

    public $perPage;

    /**
     * @return void
     */
    public function Mount(): void
    {
        $this->options = [10, 15, 20];
        $this->perPage = $this->options[1];
    }

    public function UpdatedPerPage()
    {
        $this->emit('perPageUpdated', $this->perPage);
    }

    /**
     * @return View|Factory
     */
    public function render(): View|Factory
    {
        return view('livewire.select-pagination');
    }
}
