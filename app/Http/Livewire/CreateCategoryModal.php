<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CreateCategoryModal extends Component
{
    public $title;

    protected $rules = ['title' => 'required'];

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function submit() {
        $this->validate();

        Category::create([
            'title' => $this->title,
            'user_id' => auth()->user()->id
        ]);

        $this->dispatchBrowserEvent('close:modal');

        $this->title = '';

        $this->emit('submitCategory');
    }

    public function render()
    {
        return view('livewire.create-category-modal');
    }
}
