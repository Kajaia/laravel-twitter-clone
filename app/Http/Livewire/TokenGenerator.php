<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TokenGenerator extends Component
{
    public $user;
    public $token;

    public function generate() 
    {
        $this->token = $this->user->createToken('auth_token')->plainTextToken;
    }

    public function render()
    {
        return view('livewire.token-generator');
    }
}
