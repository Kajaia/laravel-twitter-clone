<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;
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

        $followers = User::whereHas('following', function($query) {
                $query->where('followed_id', auth()->user()->id);
            })
                ->get();

        Notification::send($followers, new UserNotification(auth()->user(), auth()->user()->name.' has tweeted.'));

        $this->reset();

        $this->emit('createTweet');
    }

    public function render()
    {
        return view('livewire.create-tweet');
    }
}
