<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowUsers extends Component
{
    public $limit;

    protected $listeners = [
        'userFollow' => 'render'
    ];
    
    public function render()
    {
        return view('livewire.follow-users', [
            'users' => User::inRandomOrder()
                ->where('id', '!=', auth()->user()->id)
                ->limit($this->limit)
                ->get()
        ]);
    }
}
