<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class CreateTweet extends Component
{
    public $content;

    protected $rules = [
        'content' => 'required|max:140'
    ];

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function submit() {
        $this->validate();

        Tweet::create([
            'content' => $this->content,
            'user_id' => auth()->user()->id
        ]);

        $this->emit('createTweet');
    }

    public function render()
    {
        return view('livewire.create-tweet');
    }
}
