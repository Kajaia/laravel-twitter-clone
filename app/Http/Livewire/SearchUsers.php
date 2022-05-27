<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search;

    public function getUsersProperty()
    {
        return User::where('name', 'LIKE', "%{$this->search}%")
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.search-users');
    }
}
