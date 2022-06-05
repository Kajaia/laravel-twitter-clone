<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Categories\app\Actions\CreateCategoryAction;

class CreateCategoryModal extends Component
{
    public $title;

    protected $rules = ['title' => 'required'];

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    public function submit() 
    {
        $this->validate();

        (new CreateCategoryAction)($this->title);

        $this->dispatchBrowserEvent('close:modal');

        $this->reset('title');

        $this->emit('submitCategory');
    }

    public function render()
    {
        return view('livewire.create-category-modal');
    }
}
