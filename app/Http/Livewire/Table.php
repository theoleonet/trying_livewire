<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $searchTerm;

    public $perPage;

    public $orderBy;

    protected $listeners = [
        'updatedSearchTerm' => 'updateContactsWithFilter',
        'perPageUpdated' => 'updateContactsWithNewPaginationCount',
        'orderBy' => 'orderBy',
    ];

    public function mount()
    {
        $this->searchTerm = '';
        $this->perPage = 15;
        $this->orderBy = 'name';
    }

    /**
     * @return void
     */
    public function updateContactsWithFilter($searchTerm): void
    {
        $this->searchTerm = $searchTerm;
        $this->resetPage();
    }

    public function updateContactsWithNewPaginationCount($perPage)
    {
        $this->perPage = $perPage;
        $this->resetPage();
    }

    public function orderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return View|Factory
     */
    public function render(): View|Factory
    {
        return view('livewire.table', [
            'contacts' => Contact::query()
            ->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('email', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->orderBy, 'asc')
            ->paginate($this->perPage),
        ]);
    }
}
