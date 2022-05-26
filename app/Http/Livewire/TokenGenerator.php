<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TokenGenerator extends Component
{
    public $user;
    public $token;

    public function generate() 
    {
        $this->token = User::findOrFail($this->user->id)
            ->createToken('auth_token')
            ->plainTextToken;
    }

    public function render()
    {
        return view('livewire.token-generator');
    }
}
