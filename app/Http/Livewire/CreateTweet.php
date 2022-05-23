<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tweet;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class CreateTweet extends Component
{
    public $content;
    public $category_id;

    protected $listeners = [
        'submitCategory' => 'render',
        'deleteCategory' => 'render',
        'deleteCategory' => 'mount',
        'createTweet' => 'mount'
    ];

    protected $rules = [
        'content' => 'required|max:140',
        'category_id' => 'required'
    ];

    public function mount() {
        $this->category_id = Category::where('user_id', auth()->user()->id)
            ->first()
            ->id ?? null;
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function submit() {
        $this->validate();

        Tweet::create([
            'content' => $this->content,
            'user_id' => auth()->user()->id,
            'category_id' => $this->category_id
        ]);

        $followers = User::whereHas('following', function($query) {
                $query->where('followed_id', auth()->user()->id);
            })
                ->get();

        Notification::send($followers, new UserNotification(auth()->user(), auth()->user()->name.' has tweeted.'));

        $this->reset();

        $this->emit('createTweet');
    }

    public function removeCategory($id) {
        Category::findOrFail($id)
            ->delete();

        $this->emit('deleteCategory');
    }

    public function render()
    {
        return view('livewire.create-tweet', [
            'categories' => Category::where('user_id', auth()->user()->id)
                ->orderBy('id', 'asc')
                ->get()
        ]);
    }
}
